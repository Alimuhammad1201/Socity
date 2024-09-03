@extends('user.layout.master')
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
                            <h2 class="mb-0">Welcome, {{ $user->OwnerName }}!</h2>
                            <!-- Optional Placeholder for Additional Content -->
                           
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-4 ">
                                <div class="card radius-10 border-light shadow-sm">
                                    <div class="card-body text-center">
                                        <h4 class="mb-1">FlatNumber</h4>
                                        <p class="mb-0">{{ $user->FlatNumber }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card radius-10 border-light shadow-sm">
                                    <div class="card-body text-center">
                                        <h4 class="mb-1">BlockNumber</h4>
                                        <p class="mb-0">{{$user->BlockNumber}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card radius-10 border-light shadow-sm">
                                    <div class="card-body text-center">
                                        <h4 class="mb-1">Contact No</h4>
                                        <p class="mb-0">{{$user->OwnerContactNumber}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card radius-10 border-light shadow-sm">
                                    <div class="card-body text-center">
                                        <h4 class="mb-1">Email</h4>
                                        <p class="mb-0">{{$user->OwnerEmail}}</p>
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
        <!--end row-->
      

{{-- Script --}}

@include('superadmin.flat.script')


            </div>
        </div>

    </div>
</div>
@endsection
