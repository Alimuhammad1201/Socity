<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }


    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id');
    }
}
