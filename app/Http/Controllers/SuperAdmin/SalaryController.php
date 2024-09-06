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
    public function processMonthlySalaries()
    {
        $employees = Employees::all();

        foreach ($employees as $employee) {
            $this->calculateMonthlySalary($employee->id);
        }

        return redirect()->back()->with('success', 'Salaries processed successfully.');
    }

    public function calculateMonthlySalary($employeeId)
    {
        $employee = Employees::find($employeeId);
        $monthlySalary = $employee->salary;

        // Get attendances for the current month
        $attendances = Attendance::where('employee_id', $employeeId)
            ->whereMonth('date', Carbon::now()->month)
            ->get();

        $totalLateDeduction = 0;
        $totalLeaveDeduction = 0;
        $dailySalary = $monthlySalary / 30;

        foreach ($attendances as $attendance) {
            if ($attendance->status == 'Late') {
                $totalLateDeduction += $dailySalary * 0.1;
            }

            if ($attendance->status == 'Absent') {
                $totalLeaveDeduction += $dailySalary;
            }
            if ($attendance->attendance_type == 'Leave') {
                $totalLeaveDeduction += $dailySalary;
            }
        }

        $finalSalary = $monthlySalary - ($totalLateDeduction + $totalLeaveDeduction);

        SalaryHistory::updateOrCreate(
            ['employee_id' => $employeeId, 'month' => Carbon::now()->format('F Y')],
            ['final_salary' => round($finalSalary, 2)]
        );

        return $finalSalary;
    }

    

    public function showSalaryHistory()
    {
        $salaryHistory = SalaryHistory::where('employee_id', auth()->id())->get();
        return view('employee.salary_history', compact('salaryHistory'));
    }

 

  
}
