<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $table = 'payment_status';

    protected $fillable = [
        'allotment_id',
        'payment_due',
        'status',
        'created_at',
        'updated_at',
    ];
    public function allotment()
    {
        return $this->belongsTo(Allotment::class,'allotment_id');
    }
}
