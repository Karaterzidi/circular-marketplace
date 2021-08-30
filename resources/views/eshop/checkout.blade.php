@extends('layouts.eshop')

@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Checkout</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/cart">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <h2 class="h5 text-uppercase mb-4">Billing details</h2>
          @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <strong>Oops!</strong> {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endforeach

          <div class="row">
            <div class="col-lg-8">
              <form action="/checkout" method="POST">
                @csrf
                <div class="row">
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="firstName">First name</label>
                    <input name="firstname" class="form-control form-control-lg" id="firstName" type="text" value="{{ old('firstname') }}" placeholder="Enter your first name">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="lastName">Last name</label>
                    <input name="lastname" class="form-control form-control-lg" id="lastName" type="text" value="{{ old('lastname') }}" placeholder="Enter your last name">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="email">Email address</label>
                    <input name="email" class="form-control form-control-lg" id="email" type="email" value="{{ old('email') }}" placeholder="e.g. Jason@example.com">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="phone">Phone number</label>
                    <input name="telephone" class="form-control form-control-lg" id="phone" type="tel" value="{{ old('telephone') }}" placeholder="e.g. +02 245354745">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="company">Company name (optional)</label>
                    <input name="company_name" class="form-control form-control-lg" id="company" type="text" value="{{ old('company_name') }}" placeholder="Your company name">
                  </div>
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="country">Country</label>
                    <input name="country" class="form-control form-control-lg" id="country" type="text" value="{{ old('country') }}" placeholder="Your country name">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label class="text-small text-uppercase" for="city">State/County</label>
                    <input name="state" class="form-control form-control-lg" id="city" type="text" value="{{ old('state') }}">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label class="text-small text-uppercase" for="state">Town/City</label>
                    <input name="town" class="form-control form-control-lg" id="state" type="text" value="{{ old('town') }}">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label class="text-small text-uppercase" for="state">Postal Code</label>
                    <input name="postal_code" class="form-control form-control-lg" id="state" type="text" value="{{ old('postal_code') }}">
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Address line 1</label>
                    <input name="address_first" class="form-control form-control-lg" id="address" type="text" value="{{ old('address_first') }}" placeholder="House number and street name">
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Address line 2</label>
                    <input name="address_second" class="form-control form-control-lg" id="addressalt" type="text" value="{{ old('address_second') }}" placeholder="Apartment, Suite, Unit, etc (optional)">
                  </div>
                  <div class="col-lg-12 form-group">
                    <button class="btn btn-dark" type="submit" >Place order</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- ORDER SUMMARY-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Your order</h5>
                  <ul class="list-unstyled mb-0">
                    @foreach($products as $product)
                    <li class="d-flex align-items-center justify-content-between"><strong class="small font-weight-bold">{{$product->title}}</strong><span class="text-muted small">{{$product->price}} × {{$product->pivot->quantity}}</span></li>
                    <li class="border-bottom my-2"></li>
                    @endforeach
                    <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Total</strong><span>${{$total}}</span></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection