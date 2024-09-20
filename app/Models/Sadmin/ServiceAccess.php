<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAccess extends Model
{
    use HasFactory;
     protected $table = 'service_access';
    protected $fillable = [
        'allotment_id',
        'service_name',
        'access_status',
        'reason',
        'created_at',
        'update_at',
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
}
