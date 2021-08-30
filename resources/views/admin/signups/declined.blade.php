@extends('layouts.admin')

@section('styles')
<!--none-->
@endsection

@section('title', 'Declined Signups')

@section('content')
<div class="container-fluid">
  
    <div class="row d-flex justify-content-center" >
      <div class="col-lg-12 mt-2 mb-3">
        <div class="card">
          <div class="card-header d-flex align-items-center bg-info text-white">
            <h3 class="h4">Declined Users</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Company</th>
                    <th>Message</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($user->firstname, 12) ?? 'N/A'}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($user->lastname, 12) ?? 'N/A'}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{Str::limit($user->company_name, 12) ?? 'N/A'}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">
                      @if($user->messages->isNotEmpty())
                        Send
                      @else
                        Not Send
                      @endif
                    </td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">
                      <button class="btn btn-info text-white" name="button" data-toggle="modal" data-target="#previewUser{{$user->id}}">Preview</button>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
              {{$users->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>




<!--Category Update Modal-->
@foreach($users as $user)
    <div class="modal fade" id="previewUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="previewUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Firstname</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->firstname ?? 'N/A'}}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="title">Lastname</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->lastname ?? 'N/A'}}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="title">Company</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->company_name ?? 'N/A'}}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="title">Email</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->email}}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="title">Address</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->address}}" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="title">Telephone</label>
                    <input disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{$user->telephone}}" autocomplete="off">
                </div>
                @foreach($user->messages as $message)
                <div class="form-group">
                    <label for="title">Message</label>
                    <textarea rows="5" disabled type="text" class="form-control" id="title" aria-describedby="titleHelp" autocomplete="off">{{$message->content}}</textarea>
                </div>
                @endforeach
                <button form="signupAccept{{$user->id}}" type="submit" class="btn btn-success">Accept</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endforeach

@foreach($users as $user)
    <form action="/admin/signups/{{$user->id}}/accept" method="POST" id="signupAccept{{$user->id}}">
        @method('PATCH')
        @csrf
    </form>
@endforeach

@endsection
