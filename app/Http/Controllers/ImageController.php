<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Image as ProductImg;

class ImageController extends Controller
{
    public function create(Product $product, Request $request)
    {
        //Using Policies to check if product belongs to the user
        $this->authorize('view', $product);

        $images = $request->file('image');

        foreach($images as $imgFile) {
            if($product->images()->count() < 4) {           //Only 5 images per product
                $imagePath = $imgFile->store('products');
                //Using Image Intervention to resize image
                $image = Image::make(public_path("storage/{$imagePath}"))->fit(450, 450);
                $image->save();
                //storing image path to the database
                $product->images()->create(['image' => $imagePath]);
            }
        } 
    }

    public function delete(Product $product, ProductImg $image)
    {
        //Using Policies to check if product belongs to the user
        $this->authorize('view', $product);
        
        //Deleting image from the storage
        $imagePath = Storage::exists($image->image);
        if ($imagePath) {
            Storage::delete($image->image);
        }

        //Deleting image to the database
        $image->delete();

        return redirect()->back();
    }
}
