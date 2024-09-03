@extends('superadmin.layout.master')
@section('page-title')
Manage Flat Area
@endsection
@section('main-content')
	<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            @include('superadmin.flatarea.table')
        </div>
    </div>
@endsection
