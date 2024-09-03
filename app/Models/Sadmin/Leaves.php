<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    use HasFactory;
    protected $fillable = [
      'employee_id',
      'leave_type',
      'start_date',
      'end_date',
      'status',
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }

}
