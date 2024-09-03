<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrNotification extends Model
{
    use HasFactory;
    protected  $fillable = [
      'notification_type',
      'status',
      'date',
      'message',
    ];
}
