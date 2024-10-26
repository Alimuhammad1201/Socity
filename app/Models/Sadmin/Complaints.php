<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
protected $fillable = ['user_id','allotment_id', 'block_id','flat_id',
    'owner_name','owner_contact','complaint_type_id',
    'description','status','admin_remarks','after_img',
    'before_img'];
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'flat_id');
    }

    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id');
    }
}
