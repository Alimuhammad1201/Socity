<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'allotment_id',
        'message',
        'sent_via',
        'sent_at',
    ];
    public function allotment()
    {
        return $this->belongsTo(Allotment::class, 'allotment_id');
    }
}
