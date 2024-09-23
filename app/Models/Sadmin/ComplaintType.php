<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintType extends Model
{
    use HasFactory;

    protected $table = 'complaint_type';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function complaints()
    {
        return $this->hasMany(Complaints::class, 'complaint_type_id');
    }
}
