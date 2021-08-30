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
                        <a class="nav-item nav-link disabled" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                        <a class="nav-item nav-link active" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="nav-profile" aria-selected="false">Option / Choices</a>
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
                    <!-- Second Tab -->
                    <div style='min-height: 35vh' class="tab-pane fade show active" id="secondTab" role="tabpanel" aria-labelledby="second-tab">
                        <div class="alert alert-primary" role="alert">
                            This step is not required - Use this step for complex products
                        </div>
                        <div style="border:none" class="card">
                            <div class="card-head mt-3">
                                <nav>
                                    <div style="border:none" class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach($product->options as $option)
                                            <a class="nav-item nav-link {{$loop->first ? 'active' : ''}}" id="{{$option->title}}" data-toggle="tab" href="#option{{$option->id}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$option->title}}</a>
                                        @endforeach
                                        <button type="button" class="btn btn-primary ml-3" data-toggle="modal" data-target="#addOptionModal"> + Option </button>
                                    </div>
                                </nav>
                            </div>

                            <div class="card-body p-0 mt-2">
                                <div class="row">
                                    <div class="col-md-12">                                                                                                                                                   
                                        <div class="tab-content mt-4" id="myTabContent">
                                            @foreach($product->options as $option)
                                                <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="option{{$option->id}}" role="tabpanel" aria-labelledby="{{$option->title}}">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mt-2 d-flex justify-content-between">
                                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                                    data-target="#editOptionModal{{$option->id}}">
                                                                    Edit <b>{{$option->title}}</b>
                                                                </button>
                                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#addChoiceModal{{$option->id}}">
                                                                    + Choice
                                                                </button>
                                                            </div>
                                                            <div class="form-group">
                                                                <ul class="list-group mt-4">
                                                                    @foreach($option->choices as $choice)
                                                                        <li class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editChoiceModal{{$choice->id}}">{{$choice->title}} </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a href="/products/create/third-step"><button class="btn btn-primary mt-2 btn-lg btn-block">Next Step</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>


<!--ADD OPTION-->
<div class="modal fade text-left" id="addOptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Option</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="/products/{{$product->id}}/options" method="POST">
                                @csrf 
                                <div class="form-group">
                                    <label for="basicInput">Title</label>
                                    <input name="title" type="text" class="form-control" id="basicInput">
                                </div>
                                <div class="form-check mt-3 mb-3">
                                    <div class="checkbox">
                                        <input name="multiple_select" type="checkbox" id="multiple" class="form-check-input"
                                            checked>
                                        <label for="multiple">Multiple Select</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary me-1 mt-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--EDIT OPTION-->
@foreach($product->options as $option)
<div class="modal fade text-left" id="editOptionModal{{$option->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit {{$option->title}}</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="updateOption{{$option->id}}" action="/products/{{$product->id}}/options/{{$option->id}}" method="POST">
                                @csrf 
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="basicInput">Title</label>
                                    <input name="title" type="text" class="form-control" id="basicInput" value="{{$option->title}}">
                                </div>
                                <div class="form-check mt-3 mb-3">
                                    <div class="checkbox">
                                        @if($option->multiple_select)
                                        <input name="multiple_select" type="checkbox" id="multiple" class="form-check-input" checked>
                                        <label for="multiple">Multiple Select</label>
                                        @else
                                        <input name="multiple_select" type="checkbox" id="multiple" class="form-check-input">
                                        <label for="multiple">Multiple Select</label>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            <form id="deleteOption{{$option->id}}" action="/products/{{$product->id}}/options/{{$option->id}}" method="POST">
                                @csrf 
                                @method('DELETE')
                            </form>
                            <button form="updateOption{{$option->id}}" type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                            <button form="deleteOption{{$option->id}}" type="submit" class="btn btn-danger me-1 mt-1">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<!--ADD CHOICE-->
@foreach($product->options as $option)
<div class="modal fade text-left" id="addChoiceModal{{$option->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Choice</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="/options/{{$option->id}}/choices" method="POST">
                                @csrf 
                                <div class="form-group">
                                    <label for="basicInput">Title</label>
                                    <input name="title" type="text" class="form-control" id="basicInput">
                                </div>                                
                                <button class="btn btn-primary me-1 mt-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!--EDIT CHOICE-->
@foreach($product->options as $option)
@foreach($option->choices as $choice)
<div class="modal fade text-left" id="editChoiceModal{{$choice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit {{$choice->title}}</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form id="updateChoice{{$choice->id}}" action="/options/{{$choice->option->id}}/choices/{{$choice->id}}" method="POST">
                                @csrf 
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="basicInput">Title</label>
                                    <input name="title" type="text" class="form-control" id="basicInput" value="{{$choice->title}}">
                                </div>
                            </form>
                            <form id="deleteChoice{{$choice->id}}" action="/options/{{$choice->option->id}}/choices/{{$choice->id}}" method="POST">
                                @csrf 
                                @method('DELETE')
                            </form>
                            <button form="updateChoice{{$choice->id}}" type="submit" class="btn btn-primary me-1 mt-1">Submit</button>
                            <button form="deleteChoice{{$choice->id}}" type="submit" class="btn btn-danger me-1 mt-1">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach

@endsection                    