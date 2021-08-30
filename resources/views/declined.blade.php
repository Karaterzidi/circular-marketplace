@extends('layouts.eshop')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-10 py-5">
            <div class="card">
                <div class="card-header">
                    <h1>Your registration was declined or you have been blocked by the Administrator</h1>
                </div>

                <div class="card-body">
                @if(!$hasMessage)
                    <form action="/signup-declined/message" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="content">Tell us what happened</label>
                            <textarea type="text" class="form-control" name="content" rows="5" id="content" aria-describedby="contentHelp" placeholder="Tell us about your problem..."></textarea>
                            <small id="emailHelp" class="form-text text-muted">We'll examine carefully your situation.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Contact us!</button>
                    </form>
                @else
                    <div class="card">
                        <div class="card-body bg-success">
                            <h4>You have send a message to the Administrator.</h4>
                        </div>   
                    </div>  
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
