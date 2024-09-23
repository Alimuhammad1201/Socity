@extends('superadmin.layout.master')
@section('page-title')
    Edit Leave
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
                                <h5 class="mb-0 text-white">Edit Leave</h5>
                            </div>
                            <hr>
                        <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('leave.update',$leaves->id ) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$leaves->id}}">
                                <div class="col-md-6">
                                    <label for="employee_id" class="form-label">Select Employees</label>
                                    <select class="form-control" id="employee_id" name="employee_id">
                                           <option value="">Nothing To Select</option>
                                       @foreach($employees as $row)
                                           <option value="{{$row->id}}"{{$row->id == $leaves->employee_id ? 'selected':''}}>{{$row->name}}</option>
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
                                        <option value="Sick" {{ old('leave_type', $leaves->leave_type)=='Sick' ? 'selected' : '' }}>Sick</option>
                                        <option value="Casual" {{ old('leave_type', $leaves->leave_type)=='Casual' ? 'selected' : '' }}>Casual</option>
                                        <option value="Vacation" {{ old('leave_type', $leaves->leave_type)=='Vacation' ? 'selected' : '' }}>Vacation</option>
                                    </select>
                                    @error('leave_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="depart" class="form-label">Employee Depart</label>
                                     <input type="text" class="form-control" id="depart"
                                           name="depart"
                                           placeholder="Rate per/sq feet" value="{{ old('depart', $leaves->employee_depart) }}" readonly>
                                    @error('depart')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Employee Designation</label>
                                     <input type="text" class="form-control" id="designation"
                                           name="designation"
                                           placeholder="Rate per/sq feet" value="{{ old('designation', $leaves->employee_desi) }}" readonly>
                                    @error('designation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Employee Email</label>
                                     <input type="text" class="form-control" id="email"
                                           name="email"
                                           placeholder="Rate per/sq feet" value="{{ old('email', $leaves->employee_email) }}" readonly>
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Employee Description</label>
                                     <textarea type="text" readonly class="form-control" rows="3" id="description"
                                           name="description"
                                           placeholder="Rate per/sq feet" >{{ old('description', $leaves->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Start Date</label>
                                     <input type="date" class="form-control" id="start_date"
                                           name="start_date"
                                           placeholder="Rate per/sq feet" value="{{ old('start_date', $leaves->start_date) }}">
                                    @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">End Date</label>
                                     <input type="date" class="form-control" id="end_date"
                                           name="end_date"
                                           placeholder="Rate per/sq feet" value="{{ old('end_date', $leaves->end_date) }}">
                                    @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="Approved" {{ old('status', $leaves->status)=='Approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="Pending" {{ old('status', $leaves->status)=='Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Rejected" {{ old('status', $leaves->status)=='Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="status" class="form-label">Add Your Description</label>
                                    <input type="text" class="form-select" id="admin_description"
                                    name="admin_description"
                                    placeholder="Add Your Description">

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
