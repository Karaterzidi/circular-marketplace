<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Option;

class OptionController extends Controller
{
    public function create(Product $product, Request $request)
    {
        //Using Policies to check if product belongs to the user
        $this->authorize('view', $product);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $slug = Str::of($validated['title'])->slug('-');

        //Check if user has an option with same title
        $sameTitleOpt = $product->options()->where('slug', $slug)->get()->isNotEmpty();
        if($sameTitleOpt) return redirect()->back()->withErrors(['title_error' => 'You already have an option with this title']);

        $product->options()->create([
            'title' => $validated['title'],
            'multiple_select' => $request->boolean('multiple_select'),
            'slug' => $slug
        ]);

        return redirect()->back();
    }

    public function update(Product $product, Option $option, Request $request)
    {
        $this->authorize('update', $option);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $slug = Str::of($validated['title'])->slug('-');

        $sameTitleOpt = $product->options()->where('slug', $slug)->get()->isNotEmpty();
        if($sameTitleOpt) return redirect()->back()->withErrors(['title_error' => 'You already have an option with this title']);

        $option->update([
            'title' => $validated['title'],
            'multiple_select' => $request->boolean('multiple_select'),
            'slug' => $slug
        ]);

        return redirect()->back();
    }

    public function delete(Product $product, Option $option)
    {
        $this->authorize('delete', $option);

        $option->delete();
        return redirect()->back();
    }
}
