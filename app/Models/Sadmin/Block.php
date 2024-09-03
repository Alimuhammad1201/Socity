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

     public function flats()
    {
        return $this->hasMany(Flat::class, 'block', 'id');
    }

 // Define relationship with Complaints model
 public function complaints()
 {
     return $this->hasMany(Complaints::class, 'block', 'id' );
 }
}
