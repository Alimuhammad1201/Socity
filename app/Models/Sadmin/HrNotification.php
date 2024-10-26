<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'building_admin_id',
        'notification_type',
        'status',
        'date',
        'message',
    ];
}
