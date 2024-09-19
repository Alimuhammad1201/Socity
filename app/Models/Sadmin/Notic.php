<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notic extends Model
{
    protected $table = 'notice';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
