<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    use HasFactory;
    protected $guarded = [
      'id',
      'created_at',
      'updated_at',
   
     
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class,'employee_id');
    }

}
