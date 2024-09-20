@extends('superadmin.layout.master')
@section('page-title')
    Add Community Hall
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-9 mx-auto ">

                    <div class="card border-top  border-white">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-category me-1 font-22 text-white"></i>
                                </div>
                                <h5 class="mb-0 text-white">Community Hall Add</h5>
                            </div>
                            <hr>

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('community_hall.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Hall Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Agreement Start"
                                           value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="rent" class="form-label">Hall Rent</label>
                                    <input type="text" class="form-control" id="rent" name="rent"
                                           placeholder="Agreement End"
                                           value="{{ old('rent') }}">
                                    @error('rent')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="capacity" class="form-label">Hall Capacity</label>
                                    <input type="text" class="form-control" id="capacity" name="capacity"
                                           placeholder="Monthly Rent" value="{{ old('capacity') }}">
                                    @error('capacity')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Hall Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           placeholder="Monthly Rent" value="{{ old('description') }}">
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light px-5">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection