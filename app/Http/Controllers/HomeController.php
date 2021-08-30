<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->limit(4)->get()->toArray();
        $products = Product::whereHas('user', function($q) {
            $q->where('is_activated', 'Accepted');
        })->inRandomOrder()->limit(8)->with('images')->get();
        return view('eshop.index', compact('categories', 'products'));
    }
}
