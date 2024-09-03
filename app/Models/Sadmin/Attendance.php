<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'employee_id',
        'date',
        'status',
        ];
    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }
}
