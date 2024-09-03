@extends('superadmin.layout.master')

@section('page-title')
    {{_('Edit Allotments')}}
@endsection

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
     
       @include('superadmin.allotments.edit_form');
    
    </div>
</div>



@endsection
