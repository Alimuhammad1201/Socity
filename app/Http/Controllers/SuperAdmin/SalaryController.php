<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sadmin\SalaryHistory;
use App\Models\Sadmin\Attendance;
use App\Models\Sadmin\Employees;
use Carbon\Carbon;

class SalaryController extends Controller
{
    public function processMonthlySalaries($employee_id)
    {
        // Employee ko fetch karein
        $employee = Employees::where('user_id',auth()->id())->find($employee_id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Total monthly salary
        $monthlySalary = $employee->salary;

        // Current month ka start aur end date
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        // Employee ki current month attendance fetch karein
        $attendances = Attendance::where('employee_id', $employee_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Salary deduction ko initialize karain
        $totalDeduction = 0;

        // Total working days aur absent days calculate karain
        $totalWorkingDays = 30; // Assume 30 days
        $leaveDays = 0;
        $halfDayCount = 0;
        $remoteDays = 0;

        // Har attendance ke liye loop chalain
        foreach ($attendances as $attendance) {
            // Agar employee ne leave liya hai to ek din ki salary deduct karein
            if ($attendance->status == 'Leave') {
                $leaveDays++;
            }

            // Agar employee ne half day kaam kiya hai
            if ($attendance->status == 'Half_Day') {
                $halfDayCount++;
            }

            // Agar employee ne remote kaam kiya hai
            if ($attendance->status == 'Remote') {
                $remoteDays++;
            }

            // Agar employee ne kam hours kaam kiya hai (8 hours ka standard assume karke)
            if ($attendance->total_hours < 8 && $attendance->status != 'Leave') {
                $hourlySalary = $monthlySalary / (30 * 8); // 30 days, 8 hours per day
                $hoursShort = 8 - $attendance->total_hours;
                $totalDeduction += $hourlySalary * $hoursShort;
            }
        }

        // Leave ki wajah se salary deduct karain
        $dailySalary = $monthlySalary / $totalWorkingDays;
        $totalDeduction += $leaveDays * $dailySalary;
        $totalDeduction += ($halfDayCount * $dailySalary) / 2; // Half day deduction

        // Final salary calculate karein
        $finalSalary = $monthlySalary - $totalDeduction;

        // View ko data pass karein
        return view('superadmin.salary.process', [
            'employee' => $employee,
            'monthlySalary' => $monthlySalary,
            'totalDeduction' => $totalDeduction,
            'finalSalary' => $finalSalary,
            'attendances' => $attendances,
            'leaveDays' => $leaveDays,
            'halfDayCount' => $halfDayCount,
            'remoteDays' => $remoteDays,
            'totalWorkingDays' => $totalWorkingDays
        ]);
    }



}
