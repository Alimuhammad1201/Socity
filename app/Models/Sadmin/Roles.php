<?php

namespace App\Models\Sadmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected  $fillable = [
        'role_name',
        'permissions'
    ];
    protected $casts = [
    'permissions' => 'array', // Cast JSON to array
];
        public function Role()
    {
        return $this->hasMany(Roles::class, 'role_id');
    }

     public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
