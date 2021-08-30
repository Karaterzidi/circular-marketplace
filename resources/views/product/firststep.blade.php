@extends('layouts.eshop')

@section('styles')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
<link href="{{ asset('css/product-create.css') }}" rel="stylesheet">
@endsection

@section('content')

<div style="margin: 3% auto 5% auto" class="container">
    <div class="row justify-content-center">
        <div class="card col-12">

            <div class="card-head mt-3">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                        <a class="nav-item nav-link disabled" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="nav-profile" aria-selected="false">Option / Choices</a>
                        <a class="nav-item nav-link disabled" id="third-tab" data-toggle="tab" href="#thirdTab" role="tab" aria-controls="nav-contact" aria-selected="false">Image</a>
                    </div>
                </nav>
            </div>
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <strong>Oops!</strong> {{$error}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
            <div class="card-body pr-5 bg-lightblue">      
                <div class="tab-content" id="nav-tabContent">
                    <!--FIRST TAB -->
                    <div class="tab-pane fade show active" id="firstTab" role="tabpanel" aria-labelledby="first-tab">
                        <div class="alert alert-warning" role="alert">
                            This step is required - Make sure to complete all fields
                        </div>
                        <form action="/products/create/first-step" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="categories">Choose Categories</label>
                                <select name="categories[]" class="selectpicker w-100" data-live-search="true" multiple data-size="20">   
                                    @foreach($categories as $category)       
                                    <optgroup label="{{$category->title}}">
                                        @foreach($category->subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Product Title</label>
                                <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter Title" autocomplete="off">
                                <small id="titleHelp" class="form-text text-muted">This field is required</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea type="text" name="description" class="form-control" id="description" aria-describedby="descriptionHelp" rows="3" placeholder="Enter Description" autocomplete="off"></textarea>
                                <small id="descriptionHelp" class="form-text text-muted">This field is required</small>
                            </div>
                            <div class="form-group">
                                <label for="validationDefaultUsername">Product Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="price">$</span>
                                    </div>
                                    <input type="text" name="price" class="form-control" id="validationDefaultUsername" placeholder="Enter Price" aria-describedby="price">
                                </div>
                                <small id="validationDefaultUsername" class="form-text text-muted">This field is required</small>
                            </div>
                            @if(auth()->user()->role == 'Company')
                            <div class="form-group">
                                <label for="validationDefaultUsername">Stock</label>
                                <div class="input-group">
                                    <input type="number" name="stock" class="form-control" id="validationDefaultUsername" value="1" min="1" aria-describedby="price">
                                </div>
                                <small id="validationDefaultUsername" class="form-text text-muted">This field is required</small>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary mt-2 btn-lg btn-block">Next Step</button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection                    