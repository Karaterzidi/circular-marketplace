@component('mail::message')
# Circular Marketplace - New Purchase

<b style="font-size: 17px;">Firstname:</b> {{$userDetails['firstname']}}<br>
<b style="font-size: 17px">Lastname:</b> {{$userDetails['lastname']}}<br>
<b style="font-size: 17px">Email:</b> {{$userDetails['email']}}<br>
<b style="font-size: 17px">Telephone:</b> {{$userDetails['telephone']}}<br>
<b style="font-size: 17px;">Company Name:</b> {{$userDetails['company_name']}}<br>
<b style="font-size: 17px">Country:</b> {{$userDetails['country']}}<br>
<b style="font-size: 17px">State:</b> {{$userDetails['state']}}<br>
<b style="font-size: 17px">Town:</b> {{$userDetails['town']}}<br>
<b style="font-size: 17px;">Postal Code:</b> {{$userDetails['postal_code']}}<br>
<b style="font-size: 17px">Address 1:</b> {{$userDetails['address_first']}}<br>
<b style="font-size: 17px">Address 2:</b> {{$userDetails['address_second']}}<br><br>
Products<br>
@foreach($products as $product)
<b style="font-size: 17px;">Title:</b> {{$product->title}}<br>
<b style="font-size: 17px">Options:</b> {{$product->pivot->options}}<br>
<b style="font-size: 17px">Quantity:</b> {{$product->pivot->quantity}}<br>
<b style="font-size: 17px">Price:</b> {{$product->price}}<br>
<hr>
@endforeach

Circular Marketplace
@endcomponent
