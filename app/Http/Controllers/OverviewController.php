<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class OverviewController extends Controller
{

    public function merchants() 
    {
        $users = User::where('is_activated', 'Accepted')->where('role', '!=', 'Admin')->with('profile')->orderBy('created_at')->paginate(30);
        return view('admin.merchants.index', compact('users'));
    }

    public function merchant(Profile $profile)
    {   
        $products = $profile->user->products()->with(['images', 'subcategories.categories'])->get();
        $reviews = $profile->reviews()->with('user.profile')->simplePaginate(20);
        //Calculating reviews stars
        $avgStars = $reviews->count() > 0 ? number_format($reviews->sum('stars') / $reviews->count(), 1) : 0;

        return view('admin.merchants.show', compact('profile', 'products', 'reviews', 'avgStars'));
    }

    public function blockMerchant(Profile $profile)
    {
        $profile->user()->update([
            'is_activated' => 'Declined'
        ]);
        
        return redirect('/admin/merchants');
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return redirect()->back();
    }

    public function products()
    {
        $products = Product::orderBy('created_at', 'desc')->with('images')->simplePaginate(50);
        return view('admin.products.index', compact('products'));
    }

    public function product(Product $product)
    {
        $reviews = $product->user->profile->reviews()->with('user.profile')->simplePaginate(20);
        return view('admin.products.show', compact('product', 'reviews'));
    }

    public function deleteProduct(Product $product)
    {
        $product->subcategories()->detach();

        //delete all images from storage
        $product->images->map(function($image) {
            $fileExists = Storage::exists($image->image);
            if ($fileExists) Storage::delete($image->image);
        });

        $product->delete();

        return redirect('/admin/products');
    }
}
