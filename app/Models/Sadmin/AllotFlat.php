<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllotFlat extends Model
{
    use HasFactory;
    protected $fillable = [
      'allotment_id',
      'flat_id',
    ];
    public function flat()
    {
        return $this->belongsTo(Flat::class, 'flat_id', 'id');
    }
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id','id');
    }

    public function allotments()
    {
        return $this->hasMany(Allotment::class, 'allotment_id');
    }

}
