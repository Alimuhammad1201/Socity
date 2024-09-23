<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Attendance;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->get();
        return view('superadmin.attendance.index',compact('attendances'));
    }

    public function create()
    {
        $employees = Employees::get();
        return view('superadmin.attendance.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'employee_id' => 'required',
           'date' => 'required',
           'status' => 'required',
        ]);
        Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'status' => $request->status,
        ]);
        return redirect()->route('attendance.index');
    }

    public function edit($id)
    {
        $attendances = Attendance::findOrFail($id);
        $employees = Employees::get();
        return view('superadmin.attendance.edit',compact('employees','attendances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           'employee_id' => 'required',
           'date' => 'required',
           'status' => 'required'
        ]);

        Attendance::findOrFail($id)->update([
           'employee_id' => $request->employee_id,
           'date' => $request->date,
           'status' => $request->status,
           'update_at' => Carbon::now(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();
        return redirect()->back();
    }


    public function showMonthlyAttendance()
    {
        // Use employee guard to get the authenticated employee
        $employee = Auth::guard('employee_guard')->user();

        // Ensure employee is authenticated
        if (!$employee) {
            return redirect()->route('employee.login')->with('error', 'You need to be logged in to view this page.');
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Fetch attendance data for the authenticated employee
        $attendances = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->with('employee.designation', 'employee.depart')
            ->get();
//        dd($attendances);

        return view('employee.attendance.attendance', compact('attendances'));
    }

    public function showMonthlyAttendanceCreate()
    {
        $employee = Auth::guard('employee_guard')->user();
        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', now()->format('Y-m-d'))
            ->first();

        return view('employee.attendance.attendence_create', compact('attendance'));
    }

    public function showMonthlyAttendanceStore(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'attendance_type' => 'required',
            'remarks' => 'nullable|string',
        ]);

        Attendance::create([
            'employee_id' => Auth::guard('employee_guard')->user()->id,
            'status' => $request->status,
            'attendance_type' => $request->attendance_type,
            'remarks' => $request->remarks,
            'date' => Carbon::today()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }

    public function checkIn(Request $request)
    {
        // Employee ka start aur end time database se nikal lo
        $employee = Employees::find($request->employee_id); // Assuming Employee model has start_time and end_time columns

        // Agar employee ka record nahi milta
        if (!$employee) {
            return back()->withErrors('Employee not found.');
        }

        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', now()->toDateString())
            ->first();

        // Agar attendance pehle se ho to error dikhao
        if ($attendance) {
            return back()->withErrors('You have already checked in for today.');
        }

        $current_time = Carbon::now('Asia/Karachi');

        // Employee ka dynamic start aur end time
        $onTimeStart = Carbon::parse($employee->start_time);
        $onTimeEnd = Carbon::parse($employee->start_time)->addMinutes(30); // 30 minutes grace period
        $lateStart = Carbon::parse($employee->start_time)->addMinutes(30); // Late start after grace period
        $lateEnd = Carbon::parse($employee->start_time)->addMinutes(60); // Late end after 1 hour

        // Dynamic status based on employee's timings
        if ($current_time->between($onTimeStart, $onTimeEnd)) {
            $status = 'On Time';
        } elseif ($current_time->between($lateStart, $lateEnd)) {
            $status = 'Late';
        } else {
            $status = 'Absent'; // Default to Absent for times after $lateEnd
        }

        // Attendance record create karo
        Attendance::create([
            'employee_id' => $request->employee_id,
            'status' => $status,
            'attendance_type' => $request->attendance_type,
            'check_in_time' => $current_time->format('H:i:s'),  // Use format 'H:i:s' for 24-hour time
            'date' => $current_time->toDateString(),
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('employee.attendance')->with('success', 'Checked in successfully.');
    }

    public function checkOut(Request $request)
    {
        // Employee ID
        $employeeId = Auth::guard('employee_guard')->user()->id;

        // Fetch attendance record for today
        $attendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('date', now()->format('Y-m-d'))
            ->first();

        if ($attendance && $attendance->check_in_time) {
            // Current time as check-out time
            $checkOutTime = Carbon::now('Asia/Karachi');
            $formatted_checkOutTime = $checkOutTime->format('H:i:s'); // 24-hour format

            // Check-in time
            $checkInTime = Carbon::parse($attendance->check_in_time);

            // Calculate total hours between check-in and check-out
            $totalMinutes = $checkOutTime->diffInMinutes($checkInTime);
            $totalHours = $totalMinutes / 60;

            // Save check-out time and total hours in database (in decimal format)
            $attendance->update([
                'check_out_time' => $formatted_checkOutTime,
                'total_hours' => round($totalHours, 2),  // Rounded to 2 decimal places
            ]);
        }

        return redirect()->route('employee.attendance')->with('success', 'Checked out successfully.');
    }

}
