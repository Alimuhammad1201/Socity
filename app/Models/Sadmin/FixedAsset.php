<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    protected $fillable = ['user_id','building_admin_id','asset_name','location','block_id','flat_id','assigned_user','purchase_date','status'];
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
