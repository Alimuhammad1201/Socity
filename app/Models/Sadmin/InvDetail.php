<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvDetail extends Model
{
    use HasFactory;

    protected $table = 'inv_detail';

    protected $guarded =  ['id', 'created_at', 'updated_at'];
}
