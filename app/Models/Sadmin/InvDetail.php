<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvDetail extends Model
{
    use HasFactory;

    protected $table = 'inv_detail';

    protected $guarded =  ['id', 'created_at', 'updated_at'];
    public function type()
    {
        return $this->belongsTo(Inv_type::class, 'Invoice_type_id');
    }

    public function invoice()
    {
        return $this->belongsTo(InvMaster::class, 'inv_master_id', 'id');
    }
}
