<?php

namespace App\Models\Sadmin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'package_type', 'start_date', 'end_date', 'status', 'payment_type', 'transaction_id', 'payment_method', 'price'];

    public function package()
    {
        return $this->hasOne(Packages::class, 'name', 'package_type');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
