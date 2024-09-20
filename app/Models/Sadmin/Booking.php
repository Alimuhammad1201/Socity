<?php

namespace App\Models\Sadmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';

   protected $fillable = [
        'community_hall_id',
        'allotment_id',
        'booking_date',
        'start_time',
        'end_time',
        'amount',
        'status',
    ];

    public function communityHall()
    {
        return $this->belongsTo(CommunityHallBooking::class);
    }

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
}
