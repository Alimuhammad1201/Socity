<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
     protected $fillable = ['user_id','name', 'description'];

     public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }
}
