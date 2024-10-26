<?php

namespace App\Models;

use App\Models\Sadmin\Block;
use App\Models\Sadmin\Inv_type;
use App\Models\Sadmin\Packages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // This is necessary for authentication
use Illuminate\Notifications\Notifiable;
class Building_Admin extends Authenticatable
{
    use Notifiable;
    protected $table = 'building_admins';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'assign_building',
        'feature',
    ];
    protected $hidden = [
        'password',
    ];
    public function building()
    {
        return $this->belongsTo(Building::class, 'assign_building'); // Assuming 'id' is the primary key in the Building table
    }
    public function getBuildingAccessFeatures()
    {
        // Assuming 'feature' column contains comma-separated values
        return explode(',', $this->feature);
    }
    public function getAccessFeatures()
    {
        // Assuming 'feature' column contains comma-separated values
        return explode(',', $this->feature);
    }
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    public function invoicetype()
    {
        return $this->hasMany(Inv_type::class);
    }

}
