<?php

namespace App\Models\sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id');
    }
}
