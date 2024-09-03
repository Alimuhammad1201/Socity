<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepart extends Model
{
    protected $table = 'employee_depart';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function employee()
    {
        return $this->hasMany(Employees::class, 'depart_id');
    }
}

 