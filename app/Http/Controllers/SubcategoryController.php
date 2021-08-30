<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{

    public function notOwned()
    {
        $subcategories = Subcategory::doesntHave('categories')->get();
        $formCategories = Category::orderBy('position')->get();
        return view('admin.subcategories.notowned', compact('subcategories', 'formCategories'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'categories' => ['required'],
            'title' => ['required', 'string','max:255', 'unique:categories'],
            'description' => ['nullable', 'string', 'max:400']
        ]);

        $slug = Str::of($validated['title'])->slug('-');

        $subcategory = Subcategory::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $slug
        ]);

        foreach($validated['categories'] as $id) {
            $category = Category::findOrFail($id);
            $subcategory->categories()->attach($id); 
        }

        return redirect()->back();
    }

    public function update(Subcategory $subcategory, Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string','max:255', 'unique:categories'],
            'description' => ['nullable', 'string', 'max:400']
        ]);

        $slug = Str::of($validated['title'])->slug('-');

        $subcategory->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $slug
        ]);

        $categories = $request->input('categories');

        $subcategory->categories()->detach();

        if($categories) {
            foreach($categories as $id) {
                $category = Category::findOrFail($id);
                //addign subcategory to categories
                $subcategory->categories()->attach($id); 
            }
        };

        return redirect()->back();
    }

    public function delete(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back();
    }
}
