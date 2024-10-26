@extends('superadmin.layout.master')
@section('page-title')
    Dashboard
@endsection
@section('main-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-1">

                <div class="col-lg-12">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <!-- Welcome Message -->
                                <h2 class="mb-0">Welcome, </h2>
                                <!-- Optional Placeholder for Additional Content -->

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6 mb-4 ">
                                    <div class="card radius-10 border-light shadow-sm">
                                        <div class="card-body text-center">
                                            <h4 class="mb-1">Designation</h4>
{{--                                            <p class="mb-0">{{ $employee_data->designation->designation }}</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card radius-10 border-light shadow-sm">
                                        <div class="card-body text-center">
                                            <h4 class="mb-1">Depart</h4>
{{--                                            <p class="mb-0">{{ $employee_data->depart->depart_name }}</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card radius-10 border-light shadow-sm">
                                        <div class="card-body text-center">
                                            <h4 class="mb-1">Email</h4>
{{--                                            <p class="mb-0">{{ $employee->email }}</p>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="card radius-10 border-light shadow-sm">
                                        <div class="card-body text-center">
                                            <h4 class="mb-1">Status</h4>
{{--                                            <p class="mb-0">{{$employee->status}}</p>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                    {{-- Script --}}
                </div>
            </div>

        </div>
    </div>
@endsection
