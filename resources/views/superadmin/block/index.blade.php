@extends('superadmin.layout.master')
@section('page-title')
{{_('Manage Block')}}
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">{{_('Manage Block')}}</h6>
        <hr>
        <div class="row gap-4">
                   <div class="col-md-8 card">
            <div class="card-body">
              @include('superadmin.block.table')
            </div>
        </div>
        <div class="col-md-3 card" style="height: 100%">
            <div class="card-body">
                @include('superadmin.block.form')
            </div>
        </div>
    </div>



    </div>
</div>
@endsection
