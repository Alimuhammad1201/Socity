<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_admin_id',
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
    ];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',

    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }

}
