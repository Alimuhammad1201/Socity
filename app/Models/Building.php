<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'building_name',
      'address',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
