@extends('superadmin.layout.master')
@section('page-title')
    Add Employees
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
                                <h5 class="mb-0 text-white">Employees Add</h5>
                            </div>
                            <hr>

                            <!-- Display Validation Errors -->
                        {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}

                        <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('employees.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation</label>
                                    <select class="form-control" id="designation" name="designation">
                                        <option selected>Select Designation</option>
                                        @foreach ($designation as $row )
                                        <option value="{{$row->id}}">{{$row->designation}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="depart" class="form-label">Depart</label>
                                    <select class="form-control" id="depart" name="depart">
                                        <option selected>Select Depart</option>
                                        @foreach ($depart as $row )
                                        <option value="{{$row->id}}">{{$row->depart_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('depart')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Salary" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="st_time" class="form-label">Start Time</label>
                                    <input type="time" class="form-control" id="st_time" name="st_time" placeholder="Start Time" value="{{ old('st_time') }}">
                                    @error('st_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="en_time" class="form-label">End Time</label>
                                    <input type="time" class="form-control" id="en_time" name="en_time" placeholder="End Time" value="{{ old('en_time') }}">
                                    @error('en_time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{ old('salary') }}">
                                    @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="Active" {{ old('status')=='Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status')=='Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="hire_date" class="form-label">Hire date</label>
                                    <input type="date" class="form-control" id="hire_date" name="hire_date" placeholder="Hire Date" value="{{ old('hire_date') }}">
                                    @error('hire_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>

                                <div class="col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-light px-5">Register</button>
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
