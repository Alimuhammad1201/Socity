@extends('superadmin.layout.master')
@section('page-title')
    Edit Employees
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
                                <h5 class="mb-0 text-white">Employees Edit</h5>
                            </div>
                            <hr>
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('employees.update', $employees->id) }}" method="POST">
{{--                                @method('PUT')--}}
                                @csrf
                                <div class="col-md-6">
                                    <label for="flat_no" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Name"
                                           value="{{ old('name', $employees->name) }}">
                                    @error('flat_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation"
                                           placeholder="Designation"
                                           value="{{ old('designation', $employees->designation) }}">
                                    @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary"
                                           placeholder="Salary"
                                           value="{{ old('salary', $employees->salary) }}">
                                    @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="Nothing Selected" selected>Nothing Selected</option>
                                        <option value="Active" {{ old('status', $employees->status)=='Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $employees->status)=='Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="hire_date" class="form-label">Hire date</label>
                                    <input type="date" class="form-control" id="hire_date"
                                           name="hire_date"
                                           placeholder="Rate per/sq feet" value="{{ old('hire_date' , $employees->hire_date) }}">
                                    @error('hire_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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