@extends('layouts.eshop')

@section('styles')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<link href="{{ asset('css/product-create.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('product/dropzone/basic.css') }}" id="theme-stylesheet" rel="stylesheet">
<link href="{{ asset('product/dropzone/dropzone.css') }}" id="theme-stylesheet" rel="stylesheet">
@endsection

@section('content')

<div style="margin: 3% auto 5% auto" class="container">
    <div class="row justify-content-center">
        <div class="card col-12">

            <div class="card-head mt-3">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link disabled" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                        <a class="nav-item nav-link disabled" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="nav-profile" aria-selected="false">Option / Choices</a>
                        <a class="nav-item nav-link active" id="third-tab" data-toggle="tab" href="#thirdTab" role="tab" aria-controls="nav-contact" aria-selected="false">Image</a>
                    </div>
                </nav>
            </div>

            <div class="card-body pr-5 bg-lightblue">      
                <div class="tab-content" id="nav-tabContent">
                    <!-- Third Tab -->
                    <div class="tab-pane fade show active mt-3 mb-3" id="thirdTab" role="tabpanel" aria-labelledby="third-tab">
                        <div class="alert alert-success" role="alert">
                            This step is not required - Use this step to add images for your products
                        </div>
                        
                        <div class="row">
                        @foreach($product->images as $image)
                                <div class="col-4">
                                    <img class="img-fluid mb-3" src="/storage/{{$image->image}}" width="200px">
                                </div>
                        @endforeach
                        </div>
                        @if($product->images()->count() < 5)
                        <form action="/products/{{$product->id}}/images/create" class="dropzone dz-clickable mt-5" id="my-awesome-dropzone" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="dz-default dz-message">
                                <i style="font-size:50px;" class="icon-picture"></i><br>
                                <span>Σύρετε τα αρχεία ή κάνετε κλικ εδώ.</span>
                            </div>
                        </form>
                        @endif
                    </div>
                    <form action="/products/complete" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-2 btn-lg btn-block">FINISH</button>
                    </form>
                </div> 
                
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="{{ asset('product/dropzone/dropzone.js') }}"></script>
@endsection

@endsection                    