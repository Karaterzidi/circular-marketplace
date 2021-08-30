<?php

namespace App\Policies;

use App\Models\Choice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChoicePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->role == "Admin") return true;
    }

    public function view(User $user, Choice $choice)
    {
        return $user->id === $choice->option->product->user->id;
    }
    
    public function update(User $user, Choice $choice)
    {
        return $user->id === $choice->option->product->user->id;
    }

    public function delete(User $user, Choice $choice)
    {
        return $user->id === $choice->option->product->user->id;
    }
}
