<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
        //Fetch Categories
        $categories = Category::withCount('subcategories')->orderBy('position')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string','max:255', 'unique:categories'],
            'description' => ['nullable', 'string', 'max:400']
        ]);

        $position = Category::max('position') + 1; //Settign Max Position 
        $slug = Str::of($validated['title'])->slug('-'); //Setting Slug

        Category::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'position' => $position,
            'slug' => $slug
        ]);

        return redirect()->back();
    }

    public function show(Category $category)
    {
        $category->load('subcategories');
        //Fetch Category
        $formCategories = Category::orderBy('position')->get();
        return view('admin.categories.show', compact('category', 'formCategories'));
    }

    public function update(Category $category, Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string','max:255', 'unique:categories'],
            'description' => ['nullable', 'string', 'max:400']
        ]);

        $slug = Str::of($validated['title'])->slug('-');

        $category->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $slug
        ]);

        return redirect()->back();
    }

    public function delete(Category $category)
    {
        //Handling position for the rest categories
        $categories = Category::where('position', '>', $category->position)->get()->map(function($cat) {
            $cat->position--;
            $cat->save();
        });

        $category->delete();

        return redirect()->back();
    }

    public function position(Request $request)
    {
        $orderedIds = $request->input('position');

        for ($i=0; $i < count($orderedIds); $i++)
        {
            $category = Category::find($orderedIds[$i]);
            $category->position = $i + 1; // +1 so they start from 1
            $category->save();
        }

        return redirect()->back();
    }
}
