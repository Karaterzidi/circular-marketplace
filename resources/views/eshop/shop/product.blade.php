@extends('layouts.eshop')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
@endsection

@section('content')

  @foreach($featured as $prod)
    <!--  Modal Product-->
      <div class="modal fade" id="{{$prod->slug}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="row align-items-stretch">
                <div style="min-height: 450px" class="col-lg-6 p-lg-0">
                  @if($prod->images()->first())
                    <a class="product-view d-block h-100 bg-cover bg-center" style="background: url(/storage/{{$prod->images()->first()->image}})" href="/storage/{{$prod->images()->first()->image}}" data-lightbox="productview{{$prod->id}}" title="image"></a>
                  @else
                    <a class="product-view d-block h-100 bg-cover bg-center" style="background: url(/storage/products/default.png)" href="/storage/products/default.png" data-lightbox="{{$prod->id}}" title="Red digital smartwatch"></a>
                  @endif
                </div>
                <div class="col-lg-6">
                  <button class="close p-4" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <div class="p-5 my-md-4">                  
                    <h2 class="h4">{{$prod->title}}</h2>
                    <p class="text-muted">${{$prod->price}}</p>
                    <p class="text-small mb-4">{{$prod->description}}</p>
                    <div class="row align-items-stretch mb-4">
                      <div class="col-sm-7 pr-sm-0">
                        <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Stock</span>
                          <div class="quantity">
                            <input class="form-control border-0 shadow-0 p-0" type="text" value="{{$prod->stock}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5 pl-sm-0"><a class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="/shop/products/{{$prod->slug}}">Visit Product</a></div>
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


  <section class="py-5">
    <div class="container">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
          <strong>Oops!</strong> {{$error}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endforeach
      <div class="row mb-3">
        <div class="col-12">
          <h5><a href="/profile/{{$product->user->profile->uuid}}">Merchant: {{$product->user->company_name}} {{$product->user->firstname}} {{$product->user->lastname}}</h5></a>
        </div>
      </div>
      <div class="row mb-0">
        <div class="col-lg-6">
          <!-- PRODUCT SLIDER-->
          <div class="row m-sm-0">
            <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
              <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">
                @forelse($product->images as $image)
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="/storage/{{$image->image}}" alt="..."></div>
                @empty
                <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0"><img class="w-100" src="/storage/products/default.png" alt="..."></div>
                @endforelse
              </div>
            </div>
            <div class="col-sm-10 order-1 order-sm-2">
              <div class="owl-carousel product-slider" data-slider-id="1">
                @forelse($product->images as $image)
                <a class="d-block" href="/storage/{{$image->image}}" data-lightbox="product" title="Image"><img class="img-fluid" src="/storage/{{$image->image}}" alt="..."></a>
                @empty
                <a class="d-block" href="/storage/products/default.png" data-lightbox="product" title="Image"><img class="img-fluid" src="/storage/products/default.png" alt="..."></a>
                @endforelse
              </div>
            </div>
          </div>
        </div>
        <!-- PRODUCT DETAILS-->
        <div class="col-lg-6">
          <!-- <ul class="list-inline mb-2">
            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
            <li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>
          </ul> -->
          <h1>{{$product->title}}</h1>
          <p class="text-muted lead">${{$product->price}}</p>
          <p class="text-small mb-4">{{$product->description}}</p>

          <form action="/cart" method="POST">
            <input type="hidden" name="product" value="{{$product->slug}}">
            @csrf
            @foreach($product->options as $option)
              @if($option->multiple_select)
                <div class="form-group">
                    <label for="categoroptionsies">{{$option->title}}</label>
                    <select name="{{$option->slug}}[]" class="selectpicker w-100" data-live-search="false" multiple data-size="15">  
                        @foreach($option->choices as $choice) 
                        <option value="{{$choice->id}}">{{$choice->title}}</option>
                        @endforeach
                    </select>
                </div>
              @else
                <div class="form-group">
                    <label for="options">{{$option->title}}</label>
                    <select name="{{$option->slug}}[]" class="selectpicker w-100" data-live-search="false" data-size="15">  
                        @foreach($option->choices as $choice) 
                        <option value="{{$choice->id}}">{{$choice->title}}</option>
                        @endforeach
                    </select>
                </div>
              @endif
            @endforeach
            @if($product->user->role == 'Company')
            <h5>Stock: {{$product->stock}}</h5>
            @endif
            <div class="row align-items-stretch mt-4 mb-4">
              @if($product->user->role == 'Company')
              <div class="col-sm-5 pr-sm-0">
                <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                  <div class="quantity">
                    <button type="button" class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                    <input name="quantity" class="form-control border-0 shadow-0 p-0" type="text" value="1">
                    <button type="button" class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                  </div>
                </div>
              </div>
              @else
              <div class="col-sm-5 pr-sm-0">
                <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                  <div class="quantity">
                    <button type="button" class="dec-btn p-0" disabled><i class="fas fa-caret-left"></i></button>
                    <input name="quantity" class="form-control border-0 shadow-0 p-0" type="text" value="1" readonly>
                    <button type="button" class="inc-btn p-0" disabled><i class="fas fa-caret-right"></i></button>
                  </div>
                </div>
              </div>
              @endif
              <div class="col-sm-3 pl-sm-0"><button class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" type="submit">Add to cart</button></div>
            </div>
          </form>
          <br>
          <ul class="list-unstyled small d-inline-block">
            <li class="px-3 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark"></strong><a class="reset-anchor ml-2" href="#"></a></li>
          </ul>
        </div>
      </div>
      <!-- DETAILS TABS-->
      <ul class="nav nav-tabs border-0 mt-5" id="myTab" role="tablist">
        <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Merchant Information</a></li>
        <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Merchant Reviews</a></li>
      </ul>
      <div class="tab-content mb-5" id="myTabContent">
        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
          <div class="p-3 p-lg-5 bg-white">
            <h6 class="text-uppercase">Merchant Information </h6>
            <ul class="list-group list-group-flush">
              @if($product->user->role == 'Customer')
                <li class="list-group-item">Firstname: {{$product->user->firstname}}</li>
                <li class="list-group-item">Lastname: {{$product->user->lastname}}</li>
                <li class="list-group-item">Email: {{$product->user->email}}</li>
                <li class="list-group-item">Telephone: {{$product->user->telephone}}</li>
                <li class="list-group-item">Address: {{$product->user->address}}</li>
                <li class="list-group-item">Birth Date: {{$product->user->profile->birth_date}}</li>
              @else
                <li class="list-group-item">Company Name: {{$product->user->company_name}}</li>
                <li class="list-group-item">Email: {{$product->user->email}}</li>
                <li class="list-group-item">Telephone: {{$product->user->telephone}}</li>
                <li class="list-group-item">Address: {{$product->user->address}}</li>
                <li class="list-group-item">Foundation Date: {{$product->user->profile->foundation_date}}</li>
                <li class="list-group-item">Vat Number: {{$product->user->profile->vat_number}}</li>
              @endif
            </ul>
          </div>
        </div>
        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
          <div class="p-4 p-lg-5 bg-white">
            <div class="row">
              <div class="col-lg-8">
                  @forelse($reviews as $review)
                  <div class="media mb-4">
                    @if($review->user->profile->image)
                    <img class="rounded-circle" src="/storage/{{$review->user->profile->image}}" alt="" width="50">
                    @else
                    <img class="rounded-circle" src="/storage/profiles/default.jpg" alt="" width="50">
                    @endif
                    <div class="media-body ml-3">
                      <h6 class="mb-0 text-uppercase"><a href="/profile/{{$review->user->profile->uuid}}">{{$review->user->firstname}} {{$review->user->lastname}} {{$review->user->company_name}}</a></h6>
                      <ul class="list-inline mb-1 text-xs">
                        @for ($i = 1; $i <= $review->stars; $i++)
                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                        @endfor
                        @for ($i = 1; $i <= 5 - $review->stars; $i++)
                        <li class="list-inline-item m-0"><i class="fas fa-star text-secondary"></i></li>
                        @endfor
                      </ul>
                      <p class="text-small mb-0 text-muted">{{$review->content}}</p>
                    </div>
                  </div>
                  @empty                
                    <h5>No reviews yet</h5>
                  @endforelse
                  {{$reviews->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- RELATED PRODUCTS-->
      <h2 class="h5 text-uppercase mb-4">Featured products</h2>
      <div class="row">
        @foreach($featured as $prod)
        <!-- PRODUCT-->
        <div class="col-lg-3 col-sm-6">
          <div class="product text-center skel-loader">
            <div class="d-block mb-3 position-relative">
              <a class="d-block" href="/shop/products/{{$prod->slug}}">
                @if($prod->images()->first())
                <img class="img-fluid w-100" src="/storage/{{$prod->images->first()->image}}" alt="...">
                @else
                <img class="img-fluid w-100" src="/storage/products/default.png" alt="...">
                @endif
              </a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="/shop/products/{{$prod->slug}}">Add to cart</a></li>
                  <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="#{{$prod->slug}}" data-toggle="modal"><i class="fas fa-expand"></i></a></li>
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="/details">{{$prod->title}}</a></h6>
            <p class="small text-muted">${{$prod->price}}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection