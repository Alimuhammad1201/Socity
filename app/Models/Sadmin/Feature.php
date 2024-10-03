<?php

namespace App\Models\Sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function packages()
    {
        return $this->belongsToMany(Packages::class, 'package_feature');
    }
}
