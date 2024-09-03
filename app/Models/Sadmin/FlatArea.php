<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlatArea extends Model
{
    use HasFactory;
    protected $table = 'flat_area';

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function flats()
    {
        return $this->hasMany(Flat::class, 'flat_id');
    }

    public function allotments()
    {
        return $this->hasMany(Allotment::class, 'flat_id'); // 'flat_area_id' ko aap apne database mein jo foreign key hai uske according adjust kar sakte hain
    }



}
