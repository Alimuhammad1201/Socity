@extends('user.layout.master')
@section('page-title')
Register
@endsection
@section('main-content')
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        @include('user.register.form')
    </div>
</div>
<!--end page wrapper -->
@endsection
