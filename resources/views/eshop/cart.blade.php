@extends('layouts.eshop')

@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Cart</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <strong>Oops!</strong> {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endforeach
          <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
          <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class="table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                      <th class="border-0" scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                    <tr>
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <a class="reset-anchor d-block animsition-link" href="/shop/products/{{$product->slug}}">
                            @if($product->images()->first())
                            <img src="/storage/{{$product->images->first()->image}}" alt="..." width="100"/>
                            @else
                            <img src="/storage/products/default.png" alt="..." width="100"/>
                            @endif
                          </a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="/shop/products/{{$product->slug}}">{{$product->title}}</a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="mb-0 small">${{$product->price}}</p>
                      </td>
                      <td class="align-middle border-0">
                        <!-- <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                          <div class="quantity">
                            <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                            <input data-maxqt="{{$product->stock}}" class="qt-input form-control form-control-sm border-0 shadow-0 p-0" type="text" value="{{$product->pivot->quantity}}"/>
                            <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                          </div>
                        </div> -->
                        {{$product->pivot->quantity}}
                      </td>
                      <td class="align-middle border-0">
                        ${{$product->price * $product->pivot->quantity}}
                      </td>
                      
                      <td class="align-middle border-0">
                      <form action="/cart" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="cartproduct" value="{{$product->pivot->uuid}}">
                        <button type="submit" style="background:none;border:none" class="reset-anchor" href="#"><i class="fas fa-trash-alt small text-muted"></i></button></td>
                      </form>
                    </tr>
                    <tr>
                      <td colspan="4" class="font-weight-bold pb-5">{{$product->pivot->options}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- CART NAV-->
            
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Cart total</h5>
                  <ul class="list-unstyled mb-0">
                    <!-- <li class="d-flex align-items-center justify-content-between"><strong class="text-uppercase small font-weight-bold">Subtotal</strong><span class="text-muted small">$250</span></li>
                    <li class="border-bottom my-2"></li> -->
                    <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>${{$cartTotal}}</span></li>
                    <li>
                      <form action="#">
                        <div class="form-group mb-0">
                          <!-- <input class="form-control" type="text" placeholder="Enter your coupon"> -->
                          <!-- <button class="btn btn-dark btn-sm btn-block" type="submit"> <i class="fas fa-sync-alt mr-2"></i>Update Cart</button> -->
                          <a class="btn btn-outline-dark btn-sm btn-block mt-2" href="/checkout">Procceed to checkout<i class="fas fa-long-arrow-alt-right ml-2 my-2"></i></a>
                        </div>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="bg-light px-4">
                <div class="row align-items-center text-center">
                  <div class="col-12 d-flex  text-md-right"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection
