<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class StepController extends Controller
{
    public function firstStep()
    {
        //if already has uncompleted product, DO NOT let him create another product | REDIRECT HIM
        $product = auth()->user()->products()->where('completed', 0)->first();
        if($product) return redirect('/products/create/second-step');

        $categories = Category::with('subcategories')->get();
        return view('product.firststep', compact('categories'));
    }   

    public function secondStep()
    {
        //If user tries to skip first step redirect him
        $product = auth()->user()->products()->where('completed', 0)->first();
        if(!$product) return redirect('/products/create/first-step');

        $product->load('options.choices');
        return view('product.secondstep', compact('product'));
    }

    public function thirdStep()
    {
        //If user tries to skip first step redirect him
        $product = auth()->user()->products()->where('completed', 0)->with('images')->first();
        if(!$product) return redirect('/products/create/first-step');
        
        return view('product.thirdstep', compact('product'));
    }   
    

}
