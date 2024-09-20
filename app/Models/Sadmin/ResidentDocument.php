<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentDocument extends Model
{
    use HasFactory;
    protected $fillable = [
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
