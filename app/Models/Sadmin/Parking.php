<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;
    protected $table = 'parking';
    protected $fillable = [
        'user_id',
        'building_admin_id',
        'allotment_id',
        'parking_space_number',
        'vehicle_number',
        'parking_status',
        ];
    public function allotment( )
    {
        return $this->belongsTo(Allotment::class);
    }
}
