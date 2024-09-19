@extends('superadmin.layout.master')

@section('page-title')
    {{_('Edit Invoice')}}
@endsection

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
     
       @include('superadmin.invoice.edit_form');
    
    </div>
</div>



@endsection
