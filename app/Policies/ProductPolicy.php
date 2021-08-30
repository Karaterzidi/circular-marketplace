<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->role == "Admin") return true;
    }

    public function view(User $user, Product $product)
    {
        return $user->id === $product->user->id;
    }
    
    public function update(User $user, Product $product)
    {
        return $user->id === $product->user->id;
    }

    public function delete(User $user, Product $product)
    {
        return $user->id === $product->user->id;
    }

}
