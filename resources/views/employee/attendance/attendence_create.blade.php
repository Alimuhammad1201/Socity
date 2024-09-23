@extends('employee.layout.master')
@section('page-title')
    Add Attendance
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-12 ">

                    <div class="card border-top border-white">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-category me-1 font-22 text-white"></i></div>
                                <h5 class="mb-0 text-white">Add Attendance</h5>
                            </div>
                            <hr>

                            <!-- Display Success Message -->
                            @if (session('success'))
                                <div class="alert alert-warning">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @php
                                // Check if the employee has already checked in and checked out today
                                $today = now()->format('Y-m-d');
                                $attendanceToday = $attendance && $attendance->date === $today;
                            @endphp
                            <form class="row g-3" action="{{ route('employee.attendance.store') }}" method="POST">
                            @csrf
                            <!-- Employee ID (hidden) -->
                                <input type="hidden" name="employee_id"
                                       value="{{ Auth::guard('employee_guard')->user()->id }}">

                                <!-- Department (readonly) -->
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name="department"
                                           value="{{ Auth::guard('employee_guard')->user()->depart->depart_name }}"
                                           readonly>
                                </div>

                                <!-- Designation (readonly) -->
                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation"
                                           value="{{ Auth::guard('employee_guard')->user()->designation->designation }}"
                                           readonly>
                                </div>

                                <!-- Status (hidden, will be set based on check-in time) -->
                                <input type="hidden" id="status" name="status" value="{{ old('status') }}">

                                <!-- Attendance Type -->
                                <div class="col-md-6">
                                    <label for="attendance_type" class="form-label">Attendance Type</label>
                                    <select class="form-control" id="attendance_type" name="attendance_type">
                                        <option value="Full_Day" {{ old('attendance_type')=='Full_Day' ? 'selected' : '' }}>
                                            Full Day
                                        </option>
                                        <option value="Half_Day" {{ old('attendance_type')=='Half_Day' ? 'selected' : '' }}>
                                            Half Day
                                        </option>
                                        <option value="Remote" {{ old('attendance_type')=='Remote' ? 'selected' : '' }}>
                                            Remote
                                        </option>
                                        <option value="Leave" {{ old('attendance_type')=='Leave' ? 'selected' : '' }}>
                                            Leave
                                        </option>
                                    </select>
                                    @error('attendance_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Date -->
                                <div class="col-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{ $attendance ? $attendance->date : now()->format('Y-m-d') }}"
                                           readonly>
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remarks -->
                                <div class="col-6">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks"
                                              rows="3">{{ old('remarks') }}</textarea>
                                    @error('remarks')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Check-in Button -->
                                <div class="col-md-6">
                                    <label for="check_in_time" class="form-label">Check In</label>
                                    <input type="text" class="form-control" id="check_in_time" name="check_in_time"
                                           value="{{ $attendance ? \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i:s A') : '' }}"
                                           readonly>
                                    <button type="submit" formaction="{{ route('employee.attendance.check-in') }}"
                                            class="btn btn-primary mt-2"
                                            {{ $attendance && $attendance->check_in_time ? 'disabled' : '' }}>Check In
                                    </button>
                                </div>

                                <!-- Check-out Button -->
                                <div class="col-md-6">
                                    <label for="check_out_time" class="form-label">Check Out</label>
                                    <input type="text" class="form-control" id="check_out_time" name="check_out_time"
                                           value="{{ $attendance ? \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i:s A') : '' }}"
                                           readonly>
                                    <button type="submit" formaction="{{ route('employee.attendance.check-out') }}"
                                            class="btn btn-primary mt-2"
                                            {{ !$attendance || $attendance->check_in_time && $attendance->check_out_time ? 'disabled' : '' }}>
                                        Check Out
                                    </button>
                                </div>
{{--                            <form action="{{ route('employee.attendance.store') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Employee ID</th>--}}
{{--                                        <th>Department</th>--}}
{{--                                        <th>Designation</th>--}}
{{--                                        <th>Status</th>--}}
{{--                                        <th>Attendance Type</th>--}}
{{--                                        <th>Date</th>--}}
{{--                                        <th>Remarks</th>--}}
{{--                                        <th>Check In</th>--}}
{{--                                        <th>Check Out</th>--}}

{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    <!-- Employee ID (hidden) -->--}}
{{--                                    <tr>--}}

{{--                                        <td>--}}
{{--                                            <input type="hidden" name="employee_id"--}}
{{--                                                   value="{{ Auth::guard('employee_guard')->user()->id }}">--}}
{{--                                            {{ Auth::guard('employee_guard')->user()->id }}--}}
{{--                                        </td>--}}


{{--                                    <!-- Department (readonly) -->--}}


{{--                                        <td>--}}
{{--                                            <input type="text" class="form-control" id="department" name="department"--}}
{{--                                                   value="{{ Auth::guard('employee_guard')->user()->depart->depart_name }}"--}}
{{--                                                   readonly>--}}
{{--                                        </td>--}}


{{--                                    <!-- Designation (readonly) -->--}}


{{--                                        <td>--}}
{{--                                            <input type="text" class="form-control" id="designation" name="designation"--}}
{{--                                                   value="{{ Auth::guard('employee_guard')->user()->designation->designation }}"--}}
{{--                                                   readonly>--}}
{{--                                        </td>--}}


{{--                                    <!-- Status (hidden) -->--}}


{{--                                        <td>--}}
{{--                                            <input type="hidden" id="status" name="status" value="{{ old('status') }}">--}}
{{--                                        </td>--}}


{{--                                    <!-- Attendance Type -->--}}


{{--                                        <td>--}}
{{--                                            <select class="form-control" id="attendance_type" name="attendance_type">--}}
{{--                                                <option value="Full_Day" {{ old('attendance_type')=='Full_Day' ? 'selected' : '' }}>--}}
{{--                                                    Full Day--}}
{{--                                                </option>--}}
{{--                                                <option value="Half_Day" {{ old('attendance_type')=='Half_Day' ? 'selected' : '' }}>--}}
{{--                                                    Half Day--}}
{{--                                                </option>--}}
{{--                                                <option value="Remote" {{ old('attendance_type')=='Remote' ? 'selected' : '' }}>--}}
{{--                                                    Remote--}}
{{--                                                </option>--}}
{{--                                                <option value="Leave" {{ old('attendance_type')=='Leave' ? 'selected' : '' }}>--}}
{{--                                                    Leave--}}
{{--                                                </option>--}}
{{--                                            </select>--}}
{{--                                            @error('attendance_type')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </td>--}}


{{--                                    <!-- Date -->--}}


{{--                                        <td>--}}
{{--                                            <input type="date" class="form-control" id="date" name="date"--}}
{{--                                                   value="{{ $attendance ? $attendance->date : now()->format('Y-m-d') }}"--}}
{{--                                                   readonly>--}}
{{--                                            @error('date')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </td>--}}


{{--                                    <!-- Remarks -->--}}


{{--                                        <td>--}}
{{--                                            <textarea class="form-control" id="remarks" name="remarks"--}}
{{--                                                      rows="3">{{ old('remarks') }}</textarea>--}}
{{--                                            @error('remarks')--}}
{{--                                            <div class="text-danger">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </td>--}}


{{--                                    <!-- Check-in Time -->--}}


{{--                                        <td>--}}
{{--                                            <input type="text" class="form-control" id="check_in_time" name="check_in_time"--}}
{{--                                                   value="{{ $attendance ? \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i:s A') : '' }}"--}}
{{--                                                   readonly>--}}
{{--                                        </td>--}}


{{--                                    <!-- Check-in Button -->--}}

{{--                                        <td colspan="2">--}}
{{--                                            <button type="submit" formaction="{{ route('employee.attendance.check-in') }}"--}}
{{--                                                    class="btn btn-primary"--}}
{{--                                                    {{ $attendance && $attendance->check_in_time ? 'disabled' : '' }}>--}}
{{--                                                Check In--}}
{{--                                            </button>--}}
{{--                                        </td>--}}


{{--                                    <!-- Check-out Time -->--}}


{{--                                        <td>--}}
{{--                                            <input type="text" class="form-control" id="check_out_time" name="check_out_time"--}}
{{--                                                   value="{{ $attendance ? \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i:s A') : '' }}"--}}
{{--                                                   readonly>--}}
{{--                                        </td>--}}


{{--                                    <!-- Check-out Button -->--}}

{{--                                        <td colspan="2">--}}
{{--                                            <button type="submit" formaction="{{ route('employee.attendance.check-out') }}"--}}
{{--                                                    class="btn btn-primary"--}}
{{--                                                    {{ !$attendance || $attendance->check_in_time && $attendance->check_out_time ? 'disabled' : '' }}>--}}
{{--                                                Check Out--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
