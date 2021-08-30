<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Fetch all products from user's cart
        $products = auth()->user()->cart->products()->with('images')->get();
        //Calculate Total
        $cartTotal = auth()->user()->cart->products->map(function($product) {
            return $product->price * $product->pivot->quantity;
        })->sum();
        return view('eshop.cart', compact('products', 'cartTotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]); 

        //Make sure the product exists
        $product = Product::where('slug', $request->input('product'))->firstOrFail();

        $options = [];

        //Handle Options & Choices
        foreach ($product->options as $option)
        {
            if ($option->multiple_select) {
                //Request all option inputs based on their slug
                $selectedChoices = $request->input($option->slug);
                //Make sure the fill the options
                if (!$selectedChoices) return redirect()->back()->withErrors(['error' => 'Complete all options']);
                foreach ($selectedChoices as $selectedChoice) 
                {
                    //Make sure choice exists
                    $choice = $option->choices()->where('id', $selectedChoice)->first();
                    if (!$choice) return redirect()->back()->withErrors(['error' => 'Invalid Option Selected']);
                    //Push selected choice to $options array "select size: Large"
                    array_push($options, "{$option->title} : {$choice->title}");
                }
            }
            else {
                $selectedChoice = $request->input($option->slug);
                $choice = $option->choices()->where('id', $selectedChoice)->first();
                if (!$choice) return redirect()->back()->withErrors(['error' => 'Invalid Option Selected']);
                array_push($options, "{$option->title} : {$choice->title}");
            }
        }

        //Handle Stock/Quantity
        $quantity = $request->input('quantity');
        if ($quantity > $product->stock) return redirect()->back()->withErrors(['error' => 'This Product is out of stock']);
        
        //Check if user has already add this product to cart and calculate total quantity
        $sumQt = auth()->user()->cart->products()->where('product_id', $product->id)->sum('quantity') + $quantity;
        if ($sumQt > $product->stock) return redirect()->back()->withErrors(['error' => 'This Product is out of stock']);
       
        //Add Products To Cart
        auth()->user()->cart->products()->attach($product->id, [
            'uuid' => Str::uuid(),
            'quantity' => $quantity, 
            'options' => implode(', ', $options)
        ]);

        return redirect('/cart');
    }
    
    public function remove(Request $request)
    {
        $request->validate(['cartproduct' => 'required']);
        //Make sure product exists
        $product = auth()->user()->cart->products()->wherePivot('uuid', $request->input('cartproduct'))->first();
        if(!$product) abort(404);
        //Remove product from cart
        auth()->user()->cart->products()->wherePivot('uuid', $request->input('cartproduct'))->detach();
        return redirect()->back();
    }
}
