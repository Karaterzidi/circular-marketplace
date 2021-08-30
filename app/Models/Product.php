<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'completed', 'slug', 'stock'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot(['uuid', 'quantity', 'options']);
    }
}
