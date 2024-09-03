<?php

namespace App\Models\sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $table = 'employee_designation';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function employees()
    {
        return $this->hasMany(Employees::class, 'designation_id');
    }

    
}
