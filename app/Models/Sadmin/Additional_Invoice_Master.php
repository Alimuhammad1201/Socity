<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_Invoice_Master extends Model
{
    use HasFactory;
    
    protected $table = 'additional_invoice_master';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
