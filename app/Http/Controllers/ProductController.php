<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function initialize(Request $request)
    {
        //Check if user has another prodcut unfinished
        $product = auth()->user()->products()->where('completed', 0)->first();
        if($product) return redirect('/products/create/second-step');

        $validated = $request->validate([
            'categories' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:400'],
            'price' => ['required', 'numeric'],
            'stock' => ['nullable'],
        ]);

        $slug = Str::of($validated['title'])->slug('-') . strval(rand());

        $product = auth()->user()->products()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'slug' => $slug,
            'stock' => auth()->user()->role == 'Company' ? $validated['stock'] : 1
        ]);

        //Remove duplicates inside input categories
        $categories = array_unique($validated['categories']);
        
        //add product to subcategories
        foreach($categories as $id) {
            $product->subcategories()->attach($id);
        }

        return redirect('/products/create/second-step');
    }

    public function complete()
    {
        $product = auth()->user()->products()->where('completed', 0)->first();
        $product->completed = true;
        $product->save();

        return redirect('/profile');
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        $product->load('options.choices');
        $categories = Category::with('subcategories')->get();
        return view('product.show', compact('product', 'categories'));
    }

    public function update(Product $product, Request $request)
    {
        $this->authorize('delete', $product);

        $validated = $request->validate([
            'categories' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:400'],
            'price' => ['required', 'numeric'],
            'stock' => ['nullable']
        ]);

        $slug = Str::of($validated['title'])->slug('-') . strval(rand());

        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'slug' => $slug,
            'stock' => auth()->user()->role == 'Company' ? $validated['stock'] : 1
        ]);

        $categories = array_unique($validated['categories']);
        //Remove product from its subcategories
        $product->subcategories()->detach();
        //Re-add product to its new subcategories
        foreach($categories as $id) {
            $product->subcategories()->attach($id);
        }

        return redirect("/profile/products/{$product->slug}");
    }

    public function delete(Product $product)
    {
        $this->authorize('delete', $product);
        $product->subcategories()->detach();

        //delete all images from storage
        $product->images->map(function($image) {
            $fileExists = Storage::exists($image->image);
            if ($fileExists) Storage::delete($image->image);
        });

        $product->delete();

        return redirect('/profile');
    }
}
