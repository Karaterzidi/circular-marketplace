<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\StarsValue;
use App\Models\Profile;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'stars' => ['required', new StarsValue],
            'content' => ['nullable', 'max:400'],
        ]);

        //Check if user tries to review himself
        $reviewSelf = auth()->user()->id == $profile->user->id;
        if ($reviewSelf) return redirect()->back()->withErrors(['reviewSelf' => 'You cannot review yourself']);

        //Check if user tries to review a merchant twice
        $hasReviewed = Review::where('user_id', auth()->user()->id)->where('profile_id', $profile->id)->first();
        if ($hasReviewed) return redirect()->back()->withErrors(['hasReviewd' => 'You have already reviewd this profile']);

        auth()->user()->reviews()->create([
            'profile_id' => $profile->id,
            'stars' => $validated['stars'],
            'content' => $validated['content']
        ]);
        
        return redirect()->back();
    }   
}
