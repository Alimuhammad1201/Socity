<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestTemporary extends Model
{
    protected $table = 'guest_temporary_detail';
    protected $guarded = ['id', 'created_at', 'updated_at'];


}
