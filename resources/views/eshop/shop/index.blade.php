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

<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Shop</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP SIDEBAR-->
              <div class="cats-sidebar col-lg-3 order-2 order-lg-1">
                <h5 class="text-uppercase mb-4">Categories</h5>
                @foreach($categories as $category)
                <div class="py-2 px-4 mb-3 bg-light"><strong class="small text-uppercase font-weight-bold">{{$category->title}}</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                  @foreach($category->subcategories as $subcategory)
                  <li class="mb-2"><a class="reset-anchor" href="/shop/categories/{{$category->slug}}/{{$subcategory->slug}}">{{$subcategory->title}}</a></li>
                  @endforeach
                </ul>
                @endforeach
              </div>
              <!-- SHOP LISTING-->
              <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <h5 class="font-weight-bold mb-0">Featured Products</h5>
                  </div>
                </div>
                <div class="row">
                  @foreach($products as $product)
                  <!-- PRODUCT-->
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
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
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="/shop/products/{{$product->slug}}">Add to cart</a></li>
                            <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#{{$product->slug}}" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="/shop/products/{{$product->slug}}">{{$product->title}}</a></h6>
                      <p class="small text-muted">${{$product->price}}</p>
                    </div>
                  </div>
                  @endforeach
                  
                <!-- PAGINATION-->
                <!-- <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center justify-content-lg-end">
                    <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                  </ul>
                 
                </nav> -->
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection