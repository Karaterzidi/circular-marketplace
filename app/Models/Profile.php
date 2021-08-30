<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'birth_date', 'foundation_date', 'vat_number', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deleteImg()
    {
        $fileExists = Storage::exists($this->image);
        if ($fileExists) {
            Storage::delete($this->image);
        }
        $this->image = null;
        $this->save();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
