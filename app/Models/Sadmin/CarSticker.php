<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSticker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','building_admin_id','allotment_id', 'car_number', 'sticker_id', 'issue_date', 'expiry_date', 'status', 'charges'
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
}
