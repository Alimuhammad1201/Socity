@extends('user.layout.master')
@section('page-title')
{{ _('View Invoice') }}
@endsection
@section('main-content')
	<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            @include('user.invoice.additional_invoice_table')
        </div>
    </div>
@endsection
