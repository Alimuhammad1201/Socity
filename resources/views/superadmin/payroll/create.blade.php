@extends('superadmin.layout.master')
@section('page-title')
    Add Payroll
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
                                <h5 class="mb-0 text-white">Payroll Add</h5>
                            </div>
                            <hr>

                        <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="row g-3" action="{{ route('payroll.store') }}" method="POST">
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
                                    <label for="salary_amount" class="form-label">Salary Amount</label>
                                    <input type="text" class="form-control" id="salary_amount" name="salary_amount"
                                           placeholder="Designation"
                                           value="{{ old('salary_amount') }}">
                                    @error('salary_amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="deducation" class="form-label">Deducations</label>
                                    <input type="text" class="form-control" id="deducation" name="deducation"
                                           placeholder="Salary"
                                           value="{{ old('deducation') }}">
                                    @error('deducation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="net_salary" class="form-label">Net Salary</label>
                                     <input type="text" class="form-control" id="net_salary" name="net_salary"
                                           placeholder="Net Salary"
                                           value="{{ old('net_salary') }}">
                                    @error('net_salary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="pay_date" class="form-label">pay date</label>
                                    <input type="date" class="form-control" id="pay_date"
                                           name="pay_date"
                                           placeholder="Rate per/sq feet" value="{{ old('pay_date') }}">
                                    @error('pay_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
{{--                                <div class="col-12">--}}
{{--                                    <label for="pay_slip" class="form-label">pay Slip</label>--}}
{{--                                    <input type="file" class="form-control" id="pay_slip"--}}
{{--                                           name="pay_slip"--}}
{{--                                           placeholder="Rate per/sq feet" value="{{ old('pay_slip') }}">--}}
{{--                                    @error('pay_slip')--}}
{{--                                    <div class="text-danger">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
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