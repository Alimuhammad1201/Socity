<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityHallBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_name',
        'description',
        'rent',
        'capecity',
        'created_at',
        'updated_at',
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
