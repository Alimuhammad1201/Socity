<?php

namespace App\Models\Sadmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
    ];
     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class,'role_id');
    }
}
