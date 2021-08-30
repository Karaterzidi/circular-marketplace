@extends('layouts.eshop')

@section('content')

    @foreach($products as $product)
    <!--  Modal Product-->
      <div class="modal fade" id="{{$product->slug}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="row align-items-stretch">
                <div style="min-height: 450px" class="col-lg-6 p-lg-0">
                  @if($product->images()->first())
                    <a class="product-view d-block h-100 bg-cover bg-center" style="background: url(/storage/{{$product->images()->first()->image}})" href="/storage/{{$product->images()->first()->image}}" data-lightbox="productview{{$product->id}}" title="image"></a>
                  @else
                    <a class="product-view d-block h-100 bg-cover bg-center" style="background: url(/storage/products/default.png)" href="/storage/products/default.png" data-lightbox="{{$product->id}}" title="Red digital smartwatch"></a>
                  @endif
                </div>
                <div class="col-lg-6">
                  <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <div class="p-5 my-md-4">                  
                    <h2 class="h4">{{$product->title}}</h2>
                    <p class="text-muted">${{$product->price}}</p>
                    <p class="text-small mb-4">{{$product->description}}</p>
                    <div class="row align-items-stretch mb-4">
                      <div class="col-sm-7 pr-sm-0">
                        <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Stock</span>
                          <div class="quantity">
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="{{$product->stock}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="/shop/products/{{$product->slug}}">Visit Product</a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    <!--  Modal Product-->

      <!-- HERO SECTION-->
      <div class="container">
        
        @if (session('success'))
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Congratulations!</h4>
            <p>{{session('success')}}</p>
            <hr>
            <p class="mb-1">We have also sent an email to your account with the details of the products you purchased!</p>
            <p class="mb-0"><b>Save the planet - Circular Marketplace</b></p>
          </div>
        @endif   
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(eshop/img/hero-banner-alt.jpg)">
          <div class="container py-5">
            <div class="row px-4 px-lg-5">
              <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Inspiration 2020</p>
                <h1 class="h2 text-uppercase mb-3">Circular Marketplace</h1><a class="btn btn-dark" href="/shop">Shop here</a>
              </div>
            </div>
          </div>
        </section>
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
          <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Save the planet</p>
            <h2 class="h5 text-uppercase mb-4">Browse our categories</h2>
          </header>
          <div class="row">
            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item" href="/shop"><img class="img-fluid" src="/storage/img/cat-img-1.jpg" alt=""><strong class="category-item-title">{{$categories[0]['title']}}</strong></a></div>
            <div class="col-md-4 mb-4 mb-md-0"><a class="category-item mb-4" href="/shop"><img class="img-fluid" src="/storage/img/cat-img-2.jpg" alt=""><strong class="category-item-title">{{$categories[1]['title']}}</strong></a><a class="category-item" href="/shop"><img class="img-fluid" src="/storage/img/cat-img-3.jpg" alt=""><strong class="category-item-title">{{$categories[2]['title']}}</strong></a></div>
            <div class="col-md-4"><a class="category-item" href="/shop"><img class="img-fluid" src="/storage/img/cat-img-4.jpg" alt=""><strong class="category-item-title">{{$categories[3]['title']}}</strong></a></div>
          </div>
        </section>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
          <header>
            <p class="small text-muted small text-uppercase mb-1">Circular Marketplace</p>
            <h2 class="h5 text-uppercase mb-4">Featured products</h2>
          </header>
          <div class="row">
            @foreach($products as $product)
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="product text-center">
                <div class="position-relative mb-3">
                  <div class="badge text-white badge-"></div>
                  <a class="d-block" href="/shop/products/{{$product->slug}}">
                  @if($product->images()->first())
                  <img class="img-fluid w-100" src="/storage/{{$product->images->first()->image}}" alt="...">
                  @else
                  <img class="img-fluid w-100" src="/storage/products/default.png" alt="...">
                  @endif
                  </a>
                  <div class="product-overlay">
                    <ul class="mb-0 list-inline">
                      <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="/cart">Add to cart</a></li>
                      <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#{{$product->slug}}" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                    </ul>
                  </div>
                </div>
                <h6> <a class="reset-anchor" href="/shop/products/{{$product->slug}}">{{$product->title}}</a></h6>
                <p class="small text-muted">${{$product->price}}</p>
              </div>
            </div>
            @endforeach
          </div>
        </section>
        <!-- SERVICES-->
        <section class="py-5 mb-5 bg-light">
          <div class="container">
            <div class="row text-center">
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#delivery-time-1"> </use>
                    </svg>
                    <div class="media-body text-center ml-3">
                      <h6 class="text-uppercase mb-1">Promote</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#helpline-24h-1"> </use>
                    </svg>
                    <div class="media-body text-center ml-3">
                      <h6 class="text-uppercase mb-1">Circular </h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#label-tag-1"> </use>
                    </svg>
                    <div class="media-body text-center ml-3">
                      <h6 class="text-uppercase mb-1">Marketplace</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection