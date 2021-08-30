@extends('layouts.admin')

@section('title', $category->title)

@section('styles')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous" ></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" defer></script>
@endsection

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

    <button class="btn btn-warning text-dark mt-3" name="button" data-toggle="modal" data-target="#createSubcategory">Create Subcategory</button>
    <div class="row d-flex justify-content-center" >
      <div class="col-lg-12 mt-2 mb-3">
        <div class="card">
          <div class="card-header d-flex align-items-center bg-info text-white">
            <h3 class="h4">Subcategories</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($category->subcategories as $subcategory)
                  <tr>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{$subcategory->title}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($subcategory->description, 15)}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">
                      <button class="btn btn-info text-white" name="button" data-toggle="modal" data-target="#updateSubcategory{{$subcategory->id}}">Update</button>
                      <button class="btn btn-danger" name="button" data-toggle="modal" data-target="#deleteSubcategory{{$subcategory->id}}">Delete</button>
                    </td>
                  </tr>  
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<!--Category Create Modal-->
<div class="modal fade" id="createSubcategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Subcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/admin/subcategories" method="POST">
          @csrf
          <div class="form-group">
            <label for="categories">Choose Categories</label>
            <select name="categories[]" class="selectpicker w-100" data-live-search="true" multiple multiple data-actions-box="true">
                @foreach($formCategories as $cat)
                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="title">Subcategory Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter Title" autocomplete="off">
            <small id="titleHelp" class="form-text text-muted">This field is required</small>
          </div>
          <div class="form-group">
            <label for="description">Subcategory Description</label>
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


<!--Category Update Modal-->
@foreach($category->subcategories as $subcategory)
  <div class="modal fade" id="updateSubcategory{{$subcategory->id}}" tabindex="-1" role="dialog" aria-labelledby="updateSubcategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Subcategory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/admin/subcategories/{{$subcategory->id}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
            <label for="categories">Choose Categories</label>
            <select name="categories[]" class="selectpicker w-100" data-live-search="true" multiple multiple data-actions-box="true">
                @foreach($formCategories as $cat)
                    @if($subcategory->categories->map->title->contains($cat->title))
                      <option selected value="{{$cat->id}}">{{$cat->title}}</option>
                    @else
                      <option  value="{{$cat->id}}">{{$cat->title}}</option>
                    @endif
                @endforeach
            </select>
          </div>
            <div class="form-group">
              <label for="title">Subcategory Title</label>
              <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="{{$subcategory->title}}" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="description">Subcategory Description</label>
              <textarea type="text" name="description" class="form-control" id="description" aria-describedby="descriptionHelp" rows="3" autocomplete="off">{{$subcategory->description}}</textarea>
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


@foreach($category->subcategories as $subcategory)
  <div class="modal fade" id="deleteSubcategory{{$subcategory->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Subcategory</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/admin/subcategories/{{$subcategory->id}}" method="POST">
            @csrf
            @method('DELETE')
            <h5 class="mt-1 mb-4">Are you sure you want to delete this Category? All Products that are included inside this Category will be deleted</h5>
            <button type="submit" class="btn btn-danger">Delete {{$subcategory->title}}</button>
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
<script>
@endsection

@endsection
