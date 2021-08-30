@extends('layouts.admin')

@section('styles')
<!--none-->
@endsection

@section('title', 'Users')

@section('content')
<div class="container-fluid">
  
    <div class="row d-flex justify-content-center" >
      <div class="col-lg-12 mt-2 mb-3">
        <div class="card">
          <div class="card-header d-flex align-items-center bg-info text-white">
            <h3 class="h4">Users</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Telephone</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($user->firstname, 12) ?? 'N/A'}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a>{{Str::limit($user->lastname, 12) ?? 'N/A'}}</a></td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{Str::limit($user->company_name, 12) ?? 'N/A'}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{Str::limit($user->email, 12)}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{Str::limit($user->address, 12)}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px">{{Str::limit($user->telephone, 12)}}</td>
                    <td style="height: 90px; text-align: left; vertical-align: middle; font-size: 18px"><a href="/admin/merchants/{{$user->profile->uuid}}"><button class="btn btn-info text-white" name="button">Preview</button></a></td>
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

@endsection
