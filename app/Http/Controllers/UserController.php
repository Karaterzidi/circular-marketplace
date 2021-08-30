<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pending()
    {
        if(auth()->user()->is_activated == "Accepted") return redirect('/');
        if(auth()->user()->is_activated == "Declined") return redirect('/signup-declined');
        return view('pending');
    }

    public function declined()
    {
        if(auth()->user()->is_activated == "Accepted") return redirect('/');
        if(auth()->user()->is_activated == "Pending") return redirect('/signup-pending');

        $hasMessage = auth()->user()->messages()->get()->isNotEmpty();
        return view('declined', compact('hasMessage'));
    }

    public function message(Request $request)
    {
        //if has already send message 
        if(auth()->user()->messages()->get()->isNotEmpty()) return redirect()->back();

        $validated = $request->validate([
            'content' => 'required|max:400'
        ]);

        auth()->user()->messages()->create([
            'content' => $validated['content']
        ]);

        return redirect()->back();
    }
}
