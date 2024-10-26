<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $table = 'employee_designation';
    protected $fillable = ['user_id', 'designation','building_admin_id'];
    protected $guarded = ['id','user_id', 'created_at', 'updated_at'];

    public function employees()
    {
        return $this->hasMany(Employees::class, 'designation_id');
    }


}
