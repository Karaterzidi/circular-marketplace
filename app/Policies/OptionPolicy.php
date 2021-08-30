<?php

namespace App\Policies;

use App\Models\Option;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->role == "Admin") return true;
    }

    public function view(User $user, Option $option)
    {
        return $user->id === $option->product->user->id;
    }
    
    public function update(User $user, Option $option)
    {
        return $user->id === $option->product->user->id;
    }

    public function delete(User $user, Option $option)
    {
        return $user->id === $option->product->user->id;
    }

}
