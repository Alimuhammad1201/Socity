<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional_Invoice_Detail extends Model
{
    use HasFactory;
    protected $table = 'additional_invoice_detail';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
