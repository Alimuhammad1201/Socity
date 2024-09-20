@extends('employee.layout.master')
@section('page-title')
    Manage Attendance
@endsection
@section('main-content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Manage Attendance</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            @php
                                $count = 1;
                            @endphp
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                    <td>{{ $attendance->employee->designation->designation }}</td>
                                    <td>{{ $attendance->employee->depart->depart_name }}</td>
                                    <!-- Check-in Time in 12-hour format -->
                                    <td>{{ $attendance->check_in_time ? \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i A') : 'N/A' }}</td>
                                    <!-- Check-out Time in 12-hour format -->
                                    <td>{{ $attendance->check_out_time ? \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i A') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML Structure -->
            {{-- Script --}}
            {{--@include('superadmin.flatarea.script')--}}
        </div>
    </div>
@endsection
