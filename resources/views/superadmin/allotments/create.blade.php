@extends('superadmin.layout.master')

@section('page-title')
    Add Allotments
@endsection

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
     
       @include('superadmin.allotments.form');
    
    </div>
</div>



@endsection
