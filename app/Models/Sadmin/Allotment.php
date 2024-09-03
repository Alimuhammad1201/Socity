<?php

namespace App\Models\sadmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Allotment extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $table = 'allotments_a';

    protected $fillable = [
        'FlatNumber', 'BlockNumber', 'OwnerName', 'OwnerEmail', 'nic',
        'OwnerContactNumber', 'OwnerAlternateContactNumber', 'OwnerMemberCount',
        'status', 'date', 'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function block()
    {
        return $this->belongsTo(Block::class, 'BlockNumber');
    }

    // Relationship with FlatArea
    public function flatArea()
    {
        return $this->belongsTo(FlatArea::class, 'FlatNumber');
    }
}
