<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSticker extends Model
{
    use HasFactory;

    protected $fillable = [
        'allotment_id', 'car_number', 'sticker_id', 'issue_date', 'expiry_date', 'status', 'charges'
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
}
