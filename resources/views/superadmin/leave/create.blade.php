@extends('superadmin.layout.master')
@section('page-title')
    Add Leave
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
                                <h5 class="mb-0 text-white">Add Leave</h5>
                            </div>
                            <hr>
                        <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('leave.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <label for="employee_id" class="form-label">Select Employees</label>
                                    <select class="form-control" id="employee_id" name="employee_id">
                                           <option value="">Nothing To Select</option>
                                       @foreach($employees as $row)
                                           <option value="{{$row->id}}">{{$row->name}}</option>
                                       @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="leave_type" class="form-label">Leave Type</label>
                                    <select class="form-control" id="leave_type" name="leave_type">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="Sick" {{ old('leave_type')=='Sick' ? 'selected' : '' }}>Sick</option>
                                        <option value="Casual" {{ old('leave_type')=='Casual' ? 'selected' : '' }}>Casual</option>
                                        <option value="Vacation" {{ old('leave_type')=='Vacation' ? 'selected' : '' }}>Vacation</option>
                                    </select>
                                    @error('leave_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Start Date</label>
                                     <input type="date" class="form-control" id="start_date"
                                           name="start_date"
                                           placeholder="Rate per/sq feet" value="{{ old('start_date') }}">
                                    @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">End Date</label>
                                     <input type="date" class="form-control" id="end_date"
                                           name="end_date"
                                           placeholder="Rate per/sq feet" value="{{ old('end_date') }}">
                                    @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="Approved" {{ old('status')=='Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Pending" {{ old('status')=='Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Rejected" {{ old('status')=='Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')
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