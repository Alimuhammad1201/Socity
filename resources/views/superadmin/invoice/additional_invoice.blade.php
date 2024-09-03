@extends('superadmin.layout.master')
@section('page-title')
    {{_('Additional Invoice')}}
@endsection
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('superadmin.invoice.additional_invoice_form')
    </div>
</div>
@endsection
