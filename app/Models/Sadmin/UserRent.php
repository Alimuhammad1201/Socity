<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRent extends Model
{
    protected $table = 'user_rents';
    protected $fillable = [
        'user_id',
    ];

    protected $guarded = ['id', 'user_id', 'created_at', 'updated_at'];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
    public function allotment()
    {
        return $this->belongsTo(Allotment::class, 'flat_id');
    }

    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id');
    }

}
