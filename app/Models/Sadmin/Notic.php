<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notic extends Model
{
    protected $table = 'notice';
protected $fillable = ['user_id','building_admin_id','title','image'];
    protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];
}
