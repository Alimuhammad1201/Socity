@extends('superadmin.layout.master')
@section('page-title')
{{ _('Manage Flat') }}
@endsection
@section('main-content')
	<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            @include('superadmin.flat.table')
        </div>
    </div>
@endsection
