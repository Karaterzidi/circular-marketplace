<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        $users = User::where('is_activated', 'Pending')->simplePaginate(10);
        return view('admin.signups.index', compact('users'));
    }

    public function blockedUsers()
    {
        $users = User::with('messages')->where('is_activated', 'Declined')->simplePaginate(10);
        
        return view('admin.signups.declined', compact('users'));
    }

    public function accept(User $user)
    {
        $user->is_activated = "Accepted";
        $user->save();

        return redirect()->back();
    }

    public function decline(User $user)
    {
        $user->is_activated = "Declined";
        $user->save();

        return redirect()->back();
    }
}
