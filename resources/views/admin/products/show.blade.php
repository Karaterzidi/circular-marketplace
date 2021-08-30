@extends('layouts.overview')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
@endsection

@section('content')

<section class="py-5">
        <div class="container">
            <div class="row my-2">
                <div class="col-12 mb-3 d-flex justify-content-center">
                    <form action="/admin/products/{{$product->slug}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
          <div class="row mb-3">
            <div class="col-12">
              <h5><a href="/admin/merchants/{{$product->user->profile->uuid}}">Merchant: {{$product->user->company_name}} {{$product->user->firstname}} {{$product->user->lastname}}</h5></a>
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
        </div>
      </section>
@endsection