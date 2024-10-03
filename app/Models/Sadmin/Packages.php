<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'features', 'price', 'duration', 'stripe_price_id'];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'package_feature');
    }

}
