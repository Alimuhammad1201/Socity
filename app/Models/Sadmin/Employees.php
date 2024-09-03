<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sadmin\Payroll;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
    	'name',
    	'designation',
    	'salary',
    	'hire_date',
    	'status',
    ];
    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }
    public function Attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }
    public function Leaves()
    {
        return $this->hasMany(Leaves::class, 'employee_id');
    }
}
