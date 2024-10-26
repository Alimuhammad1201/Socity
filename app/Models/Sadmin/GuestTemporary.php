<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestTemporary extends Model
{
    protected $table = 'guest_temporary_detail';
    protected $fillable = ['user_id','card_no','block_id','flat_id','guest_name','contact_no','email','check_in_time','check_out_time'];
    protected $guarded = ['id', 'created_at', 'updated_at'];


}
