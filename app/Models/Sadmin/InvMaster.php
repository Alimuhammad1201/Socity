<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvMaster extends Model
{
    use HasFactory;

    protected $table = 'inv_master';
    protected $guarded =  ['id', 'created_at', 'updated_at'];

    public function details()
    {
        return $this->hasMany(InvDetail::class, 'inv_master_id', 'id');
    }
}
