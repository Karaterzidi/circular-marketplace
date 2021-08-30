<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->whereHas('subcategories')->orderBy('position')->get();
        $products = Product::whereHas('user', function($q) {
            $q->where('is_activated', 'Accepted');
        })->where('completed', true)->inRandomOrder()->with('images')->limit(18)->get();
        return view('eshop.shop.index', compact('categories', 'products'));
    }

    public function category(Request $request, Category $category, Subcategory $subcategory)
    {
        //Check if price filter applied
        $sort = $request->sortBy == 'low' ? 'asc' : 'desc' ;
        //Categoris for the sidebar
        $categories = Category::with('subcategories')->whereHas('subcategories')->orderBy('position')->get();
        //Fetching products based the subcategory
        $products = $subcategory->products()->whereHas('user', function($q) {
            $q->where('is_activated', 'Accepted');
        })->where('completed', true)->with('images')->orderBy('price', $sort)->simplePaginate(4);
        return view('eshop.shop.category', compact('categories', 'category', 'subcategory', 'products'));
    }

    public function product(Product $product)
    {
        //If user tries to visit his product as a merchant redirect him to edit page
        if(auth()->user() && $product->user->id === auth()->user()->id) return redirect("/profile/products/{$product->slug}");
        //If product's user is blocked redirect user to shop page
        if($product->user->is_activated == 'Declined') return redirect('/shop');
        
        $product->load(['images', 'options.choices']);
        $reviews = $product->user->profile->reviews()->with('user.profile')->simplePaginate(20);
        $featured = Product::where('id', '<>', $product->id)->limit(4)->get();
        return view('eshop.shop.product', compact('product', 'reviews', 'featured'));
    }
}
