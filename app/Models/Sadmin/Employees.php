<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sadmin\Payroll;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Employees extends Authenticatable
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
    	'name',
    	'designation',
    	'salary',
    	'hire_date',
    	'status',
    	'depart',
    	'password',
        'email',
        'start_time',
        'end_time',
    ];
    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }
    public function Attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function depart()
    {
        return $this->belongsTo(EmployeeDepart::class,'depart_id');
    }

    public function designation()
    {
        return $this->belongsTo(EmployeeDesignation::class, 'designation_id');
    }
}
