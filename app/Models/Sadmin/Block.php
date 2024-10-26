<?php

namespace App\Models\Sadmin;

use App\Models\Building_Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = 'block';
    protected $fillable = [
        'Block_name',
        'user_id',
        'building_admin_id',
    ];
    protected $primaryKey = 'id';
    protected $guarded = ['id', 'created_at', 'updated_at'];

//    public function packages()
//    {
//        return $this->belongsToMany(Packages::class, 'package_type');
//    }

    public function flatArea()
    {
        return $this->hasMany(FlatArea::class, 'block_id');
    }
    public function flat()
    {
        return $this->hasMany(Flat::class, 'block_id');
    }

    public function allotFlat()
    {
        return $this->hasMany(AllotFlat::class);
    }
    public function buildingAdmin()
    {
        return $this->belongsTo(Building_Admin::class, 'building_admin_id');
    }
}
