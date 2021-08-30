@extends('layouts.overview')

@section('content')
<div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Products Overview</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="/admin/home">Admin Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Overview</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              
              <!-- SHOP LISTING-->
              <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <h5 class="font-weight-bold mb-0">Products</h5>
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
                <div class="row">
                  @foreach($products as $product)
                  <!-- PRODUCT-->
                  <div class="col-lg-3 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-"></div>
                          <a class="d-block" href="/admin/products/{{$product->slug}}">
                            @if($product->images()->first())
                            <img class="img-fluid w-100" src="/storage/{{$product->images->first()->image}}" alt="...">
                            @else
                            <img class="img-fluid w-100" src="/storage/products/default.png" alt="...">
                            @endif
                          </a>
                      </div>
                      <h6> <a class="reset-anchor" href="/admin/products/{{$product->slug}}">{{$product->title}}</a></h6>
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
                {{$products->links()}}
              </div>
            </div>
          </div>
        </section>
      </div>
@endsection