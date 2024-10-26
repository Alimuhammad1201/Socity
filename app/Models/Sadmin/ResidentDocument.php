<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'building_admin_id',
        'allotment_id',
        'document_type',
        'document_path',
        'created_at',
        'updated_at',
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }
}
