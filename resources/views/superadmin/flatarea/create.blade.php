@extends('superadmin.layout.master')
@section('page-title')
    Add Flat Area
@endsection
@section('main-content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        @include('superadmin.flatarea.form')
    </div>
</div>
<!--end page wrapper -->
@endsection