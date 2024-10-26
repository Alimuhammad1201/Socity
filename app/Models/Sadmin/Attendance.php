<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'user_id',
        'building_admin_id',
        'employee_id',
        'date',
        'status',
        'attendance_type',
        'check_in_time',
        'check_out_time',
        'total_hours',
        'remarks',
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }
}
