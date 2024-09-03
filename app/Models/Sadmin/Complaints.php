<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block', 'id');
    }
}
