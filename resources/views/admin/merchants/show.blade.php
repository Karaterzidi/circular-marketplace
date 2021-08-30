@extends('layouts.overview')

@section('styles')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<link href="{{ asset('css/review.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('profiles/dropzone/basic.css') }}" id="theme-stylesheet" rel="stylesheet">
<link href="{{ asset('profiles/dropzone/dropzone.css') }}" id="theme-stylesheet" rel="stylesheet">
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <form class="text-center mt-3" action="/admin/merchants/{{$profile->uuid}}" method="POST">
                @csrf
                @method('DELETE')
                @if($profile->user->is_activated == 'Accepted')
                <h5>Active User</h5>
                <button type="submit" class="btn btn-danger">
                    Block Merchant
                </button>
                @else
                <h5>Blocked User</h5>
                @endif
            </form>
        </div>
    </div>
</div>
<div style="margin: 3% auto 5% auto;" class="container">
  <div class="main-body"> 
    <div class="row gutters-sm">

      <!-- Section  Left -->
      <div class="col-md-4 mb-3">

        <!-- Profile Card -->
        <div class="card">
          <div class="card-body py-5">
            <div class="d-flex flex-column align-items-center text-center">
              <div class="img-container">
                @if($profile->image)
                <img src="/storage/{{$profile->image}}" alt="Admin" class="rounded" width="150">
                @else
                <img src="/storage/profiles/default.jpg" alt="Admin" class="rounded" width="150">
                @endif
              </div>
              <div class="mt-3">
                <h4 class="mb-3">{{$profile->user->role}}</h4>
                <!-- <button class="btn btn-primary">Follow</button> -->
              </div>
            </div>
          </div>
        </div>
        <!-- Profile Card -->

        <!-- Reviews Card -->
        <div class="review-card card mt-3">
            <div class="review-body card-body text-center"> 
                @switch($avgStars)
                    @case($avgStars <= 1)
                        <span style="color: #ff4545" class="myratings">{{$avgStars}}</span>
                        @break

                    @case($avgStars <= 2)
                        <span style="color: #ffa534" class="myratings">{{$avgStars}}</span>
                        @break

                    @case($avgStars <= 3)
                        <span style="color: #ffe234" class="myratings">{{$avgStars}}</span>
                        @break

                    @case($avgStars <= 4)
                        <span style="color: #b7dd29" class="myratings">{{$avgStars}}</span>
                        @break

                    @case($avgStars <= 5)
                        <span style="color: #57e32c" class="myratings">{{$avgStars}}</span>
                        @break

                    @default
                      <span style="color: #222" class="myratings">{{$avgStars}}</span>
                @endswitch

                <h4 class="mt-1">Ratings ({{$reviews->count()}})</h4>
                <fieldset class="rating"> 
                  <input type="radio" id="star5" name="stars" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label> 
                  <input type="radio" id="star4" name="stars" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label> 
                  <input type="radio" id="star3" name="stars" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label> 
                  <input type="radio" id="star2" name="stars" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label> 
                  <input type="radio" id="star1" name="stars" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label> 
                </fieldset>
            </div>
        </div>
        <!-- Reviews Card -->
      </div>
      <!-- Section Left -->


      <!-- Section Right -->
      <div class="col-md-8">
        <div class="card mb-3 py-2">
          <!-- Information Card -->
          <div class="card-body">     
            @if($profile->user->role == 'Customer')
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Firstname</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->firstname}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Lastname</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->lastname}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->email}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->telephone}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->address}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Birth Date</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->birth_date ?? '-'}}
                </div>
              </div>
            @endif
            @if($profile->user->role == 'Company')
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Company Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->company_name}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->email}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->telephone}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->user->address}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Foundation Date</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->foundation_date ?? '-'}}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Vat Number</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{$profile->vat_number ?? '-'}}
                </div>
              </div>
            @endif 
          </div>
          <!--Information Card -->
        </div>


        <!-- Products Card -->
        <div class="row gutters-sm">
          <div class="col-12 mb-3">
            <div class="card h-100">
                <div class="class-header d-flex justify-content-between p-3">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#products" role="tab" aria-controls="home" aria-selected="true">Uploaded Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ahh" role="tab" aria-controls="profile" aria-selected="false">Reviews</a>
                    </li>
                  </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                  <!--PRODUCTS TAB -->
                  <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="home-tab">
                    @forelse($products as $product)
                    <!--Product Item-->
                    <div class="card card-body mt-2">
                      <div class="media align-items-center  text-center text-lg-left flex-column flex-lg-row">
                          <div class="mr-2 mb-3 mb-lg-0"> 
                            @if($product->images()->first())
                              <img src="/storage/{{$product->images()->first()->image}}" width="150" height="150" alt=""> 
                            @else
                              <img src="/storage/products/default.png" width="150" height="150" alt=""> 
                            @endif
                          </div>
                          <div class="media-body ml-3">
                              <h6 class="media-title font-weight-semibold"> <a href="/admin/products/{{$product->slug}}" data-abc="true">{{$product->title}}</a> </h6>
                              <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                  @foreach($product->subcategories as $subcategory)
                                    <li class="list-inline-item"><a class="text-muted" data-abc="true">{{$subcategory->title}}</a></li>
                                  @endforeach
                                  </ul>
                              <p class="mb-3">{{$product->description}} </p>
                              
                          </div>
                          <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                              <h3 class="mb-0 font-weight-semibold">{{$product->price}} €</h3>
                          </div>
                      </div>
                    </div>  
                    <!--Product Item-->
                    @empty
                    <div class="card card-body mt-2">
                      <h5>No uploaded products</h5>
                    </div>  
                    @endforelse
                  </div>
                  <!--PRODUCTS TAB -->

                  <!--REVIEWS TAB -->
                  <div class="tab-pane fade" id="ahh" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card card-body mt-2">
                      @forelse($reviews as $review)
                      <div class="row">
                        <div class="col-8">
                          <div class="media mb-4">
                            @if($review->user->profile->image)
                            <img class="rounded-circle" src="/storage/{{$review->user->profile->image}}" alt="" width="50">
                            @else
                            <img class="rounded-circle" src="/storage/profiles/default.jpg" alt="" width="50">
                            @endif
                            <div class="media-body ml-3">
                              <h6 class="mb-0 text-uppercase"><a href="/admin/merchants/{{$review->user->profile->uuid}}">{{$review->user->firstname}} {{$review->user->lastname}} {{$review->user->company_name}}</a></h6>
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
                        </div>
                        <div class="col-4 d-flex align-items-center">
                          <form action="/admin/reviews/delete/{{$review->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Review</button>
                          </form>
                        </div>
                      </div>
                      @empty
                        <h5>No reviews yet</h5> 
                      @endforelse
                      {{$reviews->links()}}
                    </div>
                  </div>
                  <!--REVIEWS TAB -->
                </div>       
              </div>
            </div>
          </div>     
        </div>
        <!-- Products Card -->
      </div>
      <!-- Section Right -->


    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('profiles/dropzone/dropzone.js') }}"></script>
@endsection