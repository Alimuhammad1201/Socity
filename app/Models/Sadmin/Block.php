<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = 'block';
    protected $primaryKey = 'id'; 
    protected $guarded = ['id', 'created_at', 'updated_at'];

   

 public function flatArea()
 {
     return $this->hasMany(FlatArea::class, 'block_id');
 }
}
