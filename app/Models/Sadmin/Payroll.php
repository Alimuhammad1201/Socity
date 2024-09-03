<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sadmin\Employees;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = [
    	'employee_id',
    	'salary_amount',
    	'deducation',
    	'net_salary',
    	'pay_date',
    	'payslip_file',
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }
}
