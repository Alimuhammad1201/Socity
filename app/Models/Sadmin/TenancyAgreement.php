<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenancyAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'allotment_id',    // Foreign key to allotment_a table
        'agreement_start',   // Agreement start date
        'agreement_end',     // Agreement end date
        'monthly_rent',      // Monthly rent
        'payment_status',    // Payment status
        'agreement_pdf',          // PDF document of the agreement
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class, 'allotment_id');
    }
}
