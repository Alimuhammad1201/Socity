@extends('superadmin.layout.master')
@section('page-title')
    Add Attendance
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
                                <h5 class="mb-0 text-white">Attendance Add</h5>
                            </div>
                            <hr>

                        <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('attendance.store') }}" method="POST">
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
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>Nothing Selected</option>
                                        <option value="Present" {{ old('status')=='present' ? 'selected' : '' }}>Present</option>
                                        <option value="Absent" {{ old('status')=='absent' ? 'selected' : '' }}>Absent</option>
                                        <option value="Leave" {{ old('status')=='leave' ? 'selected' : '' }}>Leave</option>
                                    </select>
                                    @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date"
                                           name="date"
                                           placeholder="Rate per/sq feet" value="{{ old('date') }}">
                                    @error('date')
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