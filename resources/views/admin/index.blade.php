@extends('layouts.admin')

@section('styles')
<!--none-->
@endsection

@section('title', 'Statistics')

@section('content')

<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-red"><i class="icon-user"></i></div>
            <div class="title"><span>New<br>Users</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                </div>
            </div>
            <div class="number"><strong>{{$newUsers}}</strong></div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-violet"><i class="icon-user"></i></div>
            <div class="title"><span>Total<br>Customers</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                </div>
            </div>
            <div class="number"><strong>{{$totalCustomers}}</strong></div>
            </div>
        </div>
        <!-- Item -->
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-green"><i class="icon-user"></i></div>
            <div class="title"><span>Total<br>Companies</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                </div>
            </div>
            <div class="number"><strong>{{$totalCompanies}}</strong></div>
            </div>
        </div>
        <!-- Item -->
        
    </div>
</section>
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row bg-white has-shadow">
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-violet"><i class="icon-list"></i></div>
            <div class="title"><span>Total<br>Categories</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                </div>
            </div>
            <div class="number"><strong>{{$totalCats}}</strong></div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-red"><i class="icon-list"></i></div>
            <div class="title"><span>Total<br>Subcategories</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                </div>
            </div>
            <div class="number"><strong>{{$totalSubcats}}</strong></div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="item d-flex align-items-center">
            <div class="icon bg-violet"><i class="icon-interface-windows"></i></div>
            <div class="title"><span>Total<br>Products</span>
                <div class="progress">
                <div role="progressbar" style="width: 100%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                </div>
            </div>
            <div class="number"><strong>{{$totalProducts}}</strong></div>
            </div>
        </div>
        <!-- Item -->
    </div>
</section>
@endsection
