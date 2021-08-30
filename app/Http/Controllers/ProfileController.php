<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Profile;
use App\Models\Review;

class ProfileController extends Controller
{
    public function profile()
    {
        $products = auth()->user()->products()->where('completed', 1)->with('images')->orderBy('created_at', 'desc')->get();
        $reviews = auth()->user()->profile->reviews()->with('user.profile')->simplePaginate(20);
        //Calculating reviews stars
        $avgStars = $reviews->count() > 0 ? number_format($reviews->sum('stars') / $reviews->count(), 1) : 0;
        return view('profile', compact('products', 'reviews', 'avgStars'));
    }

    public function update(Request $request) 
    {
        $validated = $request->validate([
            'company_name' => ['nullable', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:5', 'max:255'],
            'telephone' => ['nullable', 'string', 'min:5', 'max:255'],
            'birth_date' => 'nullable|date',
            'foundation_date' => 'nullable|date',
            'vat_number' => 'nullable'
        ]);

        auth()->user()->update($validated);

        auth()->user()->profile()->update([
            'birth_date' => $validated['birth_date'] ?? '',
            'foundation_date' => $validated['foundation_date'] ?? '',
            'vat_number' => $validated['vat_number'] ?? ''
        ]);

        return redirect()->back();
    }

    public function addImage(Request $request)
    {
        $request->validate(['image' => 'required|image']);

        $imagePath = $request->file('image')->store('profiles');
         //Using Image Intervention to resize image
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(150, 150);
        $image->save();

        auth()->user()->profile->deleteImg(); //delete previous image
        auth()->user()->profile()->update(['image' => $imagePath]);
    }

    public function removeImage()
    {
        auth()->user()->profile->deleteImg(); 
        return redirect()->back();
    }

    public function merchant(Profile $profile)
    {
        //If user tries to visit his profile as merchant redirect him to his profile
        if($profile->uuid === auth()->user()->profile->uuid) return redirect('/profile');

        $products = $profile->user->products()->with(['images', 'subcategories.categories'])->get();
        
        $reviews = $profile->reviews()->with('user.profile')->simplePaginate(20);
        //Calculating reviews stars
        $avgStars = $reviews->count() > 0 ? number_format($reviews->sum('stars') / $reviews->count(), 1) : 0;
        //Check if visitor has reviewed this merchant
        $hasReviewed = Review::where('user_id', auth()->user()->id)->where('profile_id', $profile->id)->first();

        return view('eshop.merchant', compact('profile', 'products', 'reviews', 'avgStars', 'hasReviewed'));
    }
}
