<?php

namespace App\Models\Sadmin;

use App\Models\Building_Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_type extends Model
{
    use HasFactory;
    protected $table = 'invoice_type';
    protected $fillable = ['user_id','type_name', 'building_admin_id'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function types()
    {
        return $this->hasMany(InvDetail::class, 'Invoice_type_id');
    }
    public function buildingAdmin()
    {
        return $this->belongsTo(Building_Admin::class, 'building_admin_id');
    }
}
