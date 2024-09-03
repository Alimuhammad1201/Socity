@extends('superadmin.layout.master')
@section('page-title')
    Allotments
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('superadmin.allotments.table')
    </div>
</div>
@endsection
