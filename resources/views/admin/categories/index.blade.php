@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">

    @foreach($errors->all() as $error)
      <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>Oops!</strong> {{$error}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endforeach

    <button class="btn btn-warning text-dark mt-3" name="button" data-toggle="modal" data-target="#createCategory">Create Category</button>
    <button class="btn btn-secondary mt-3" name="button" data-toggle="modal" data-target="#handlePosition">Edit Position</button>
    <div class="row d-flex justify-content-center" >
      <div class="col-lg-12 mt-2 mb-3">
        <div class="card">
          <div class="card-header d-flex align-items-center bg-info text-white">
            <h3 class="h4">Categories</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Subcategories Number</th>
                    <th>Position</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a href="/admin/categories/{{$category->slug}}">{{$category->title}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($category->description, 15)}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{$category->subcategories_count}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{$category->position}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">
                      <button class="btn btn-info text-white" name="button" data-toggle="modal" data-target="#updateCategory{{$category->id}}">Update</button>
                      <button class="btn btn-danger" name="button" data-toggle="modal" data-target="#deleteCategory{{$category->id}}">Delete</button>
                    </td>
                  </tr>  
                @endforeach
                </tbody>
                <tfoot class="mt-2">
                  <tr>
                    <td colspan="5" style="height: 50px; text-align: left; vertical-align: middle; font-size: 18px"><a class="text-muted" href="/admin/subcategories/not-owned">Subcategories with no parent Categories</a></td> 
                </tr>  
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<!--Category Create Modal-->
<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/categories" method="POST">
          @csrf
          <div class="form-group">
            <label for="title">Category Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter Title" autocomplete="off">
            <small id="titleHelp" class="form-text text-muted">This field is required</small>
          </div>
          <div class="form-group">
            <label for="description">Category Description</label>
            <textarea type="text" name="description" class="form-control" id="description" aria-describedby="descriptionHelp" rows="3" placeholder="Enter Description" autocomplete="off"></textarea>
            <small id="descriptionHelp" class="form-text text-muted">This field is not required</small>
          </div>
          <button type="submit" class="btn btn-info text-white">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--Handle Position Modal-->
<div class="modal fade bd-example-modal-lg" id="handlePosition" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <!--Form for positions-->
        <form id="categoriesPosition" class="d-none" action="/admin/categories/position" method="post">
          @csrf
          @foreach($categories as $category)
          <input class="position-input" type="hidden" name="position[]" value="{{$category->id}}">
          @endforeach
        </form>
      <!--Form for positions-->
        <h5 class="modal-title" id="exampleModalLabel">Update Position</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul id="categoriesPosition" class="list-group drag-container">
        @foreach($categories as $category)
          <li draggable="true" data-position="{{$category->id}}" class="list-group-item draggable-element {{$category->id}}">{{$category->title}}</li>
        @endforeach
        </ul>

        <button type="submit" form="categoriesPosition" class="btn btn-info text-white mt-3">Save Changes</button>
      </div>
    </div>
  </div>
</div>



<!--Category Update Modal-->
@foreach($categories as $category)
  <div class="modal fade" id="updateCategory{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/admin/categories/{{$category->id}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="title">Category Title</label>
              <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{$category->title}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="description">Category Description</label>
              <textarea type="text" name="description" class="form-control" id="description" aria-describedby="descriptionHelp" rows="3" autocomplete="off">{{$category->description}}</textarea>
              <!-- <div class="form-group">
              <label for="title">Category Position</label>
              <input type="number" class="form-control" placeholder="Position" autocomplete="off"> -->
            </div>
            <button type="submit" class="btn btn-info text-white">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endforeach


@foreach($categories as $category)
  <div class="modal fade" id="deleteCategory{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/admin/categories/{{$category->id}}" method="POST">
            @csrf
            @method('DELETE')
            <h5 class="mt-1 mb-4">Are you sure you want to delete this Category</h5>
            <button type="submit" class="btn btn-danger">Delete {{$category->title}}</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endforeach


@section('scripts')
<script src="{{ asset('js/draggable.js') }}"></script>
@endsection

@endsection
