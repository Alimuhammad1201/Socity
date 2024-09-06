<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Attendance;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance) {
            return back()->withErrors('You have already checked in for today.');
        }

        $current_time = Carbon::now('Asia/Karachi');
        // Status will be 'Late' if checked in after 12 PM
//        $status = $current_time->hour < 12 ? 'Present' : 'Late';
        $onTimeStart = '11:30';
        $onTimeEnd = '12:00';
        $lateStart = '7:00';
        $lateEnd = '7:40';
        // Removed absentEnd since no status after 12:15 PM is needed

        if ($current_time >= $onTimeStart && $current_time <= $onTimeEnd) {
            $status = 'On Time';
        } elseif ($current_time > $lateStart && $current_time <= $lateEnd) {
            $status = 'Late';
        } else {
            $status = 'Absent'; // Default to Absent for times after 12:15 PM
        }


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
