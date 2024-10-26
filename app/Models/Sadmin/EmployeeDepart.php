<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepart extends Model
{
    protected $table = 'employee_depart';
    protected $fillable = ['user_id','depart_name','building_admin_id'];
    protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

    public function employee()
    {
        return $this->hasMany(Employees::class, 'depart_id');
    }
}

