@extends('superadmin.layout.master')

@section('page-title')
    Add Invoice
@endsection

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
     
       @include('superadmin.invoice.form');
    
    </div>
</div>



@endsection
