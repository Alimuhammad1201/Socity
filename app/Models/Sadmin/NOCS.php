<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOCS extends Model
{
    protected $table = 'noc';
    protected $fillable = ['user_id','building_admin_id','noc_number','name','block_id','flat_id','issue_date','valid_until','purpose','status'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    // Relationship with FlatArea
    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id');
    }
}
