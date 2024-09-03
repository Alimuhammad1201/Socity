<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_type extends Model
{
    use HasFactory;
    protected $table = 'invoice_type';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
