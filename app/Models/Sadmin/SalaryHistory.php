<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
    protected $table = 'salary_history';

    protected $fillable = ['employee_id', 'month', 'final_salary'];
}
