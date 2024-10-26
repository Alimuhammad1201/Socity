@extends('superadmin.layout.master')
@section('page-title')
    Add Building Admin
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
                                <h5 class="mb-0 text-white">Add Admin Building</h5>
                            </div>
                            <hr>
                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="row g-3" action="{{ route('admin-building.store') }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="assign_building" class="form-label">Select Assign Building</label>
                                    <select class="form-control" id="assign_building" name="assign_building">
                                        <option value="">Nothing To Select</option>
                                        @foreach($assign_building as $row)
                                            <option value="{{ $row->id }}">{{ $row->building_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_building')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="feature" class="form-label">Select Feature</label>
                                    <select class="form-control" id="feature" name="feature[]" multiple>
                                        <option value="" disabled>Select a Feature</option>
                                        @if(isset($package_feature) && is_array($package_feature))
                                            @foreach($package_feature as $feature)
                                                <option value="{{ $feature }}">{{ $feature }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('feature')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Password">
                                    @error('password')
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
