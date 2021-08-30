<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'required', 'multiple_select', 'slug'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
