<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Events\NewPurchase;
use App\Mail\PurchaseMail;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = auth()->user()->cart->products;
        if ($products->isEmpty()) return redirect('/cart'); //Redirect if cart empty
        $total = auth()->user()->cart->products->map(function($product) {
            return $product->price * $product->pivot->quantity;
        })->sum();
        return view('eshop.checkout', compact('products', 'total'));
    }

    public function checkout(Request $request)
    {
        $products = auth()->user()->cart->products;
        if ($products->isEmpty()) return redirect('/cart');

        $userDetails = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'telephone' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'postal_code' => 'required|numeric',
            'address_first' => 'required|string|max:255',
            'address_second' => 'nullable|string|max:255'
        ]);

        //Check product's stock
        foreach($products as $product)
        {
            if ($product->stock == 0) {
                auth()->user()->cart->products()->detach($product->id);
                return redirect()->back()->withErrors(['stock' => "{$product->title} is out of stock. We removed this product from your cart."]);
            }

            if ($product->pivot->quantity > $product->stock) {
                auth()->user()->cart->products()->updateExistingPivot($product->id, [
                    'quantity' => $product->stock,
                ]);
                return redirect()->back()->withErrors(['stock' => "Only {$product->stock} left in stock for {$product->title}. We updated your cart."]);
            }
        }

        //Grouping products by user_id
        $merchants = $products->groupBy('user_id');
        foreach($merchants as $userid => $prods)
        {
            //Find each user and get his email
            $email = User::findOrFail($userid)->email;
            //Send email to all merchants with the user details and the products he purchased from them
            NewPurchase::dispatch($email, $userDetails, $prods);    
        }

        $products->map(function($product) {
            //Updating product's stock for companies
            if ($product->user->role == 'Company') {
                $product->stock = $product->stock - $product->pivot->quantity;
                $product->save();
            } 
        });

        //Send email to the user that made the purchase
        NewPurchase::dispatch(auth()->user()->email, $userDetails, $products); 
        auth()->user()->cart->products()->detach();
        
        return redirect('/')->with(['success' => "Congratulations, we have sent an email to all the merchants about your purchase!"]);
    }   
}
