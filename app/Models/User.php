<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Sadmin\Packages;
use App\Models\Sadmin\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

//    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getAccessFeatures()
    {
        $subscription = $this->subscription()->first();

        if ($subscription){
            $package = Packages::where('name',$subscription->package_type)->first();
            if ($package){
                return explode(',',$package->features);
            }
        }
        return [];
    }
}

//    public function hasFeatureAccess($featureName)
//    {
//        $subscription = $this->subscription;
////        dd($subscription);
//        if (!$subscription) {
//            return false;
//        }
//
//        $package = $subscription->package;
//
//        if (!$package) {
//            return false;
//        }
//
//        // Get the features field from the package and split into an array
//        $packageFeatures = explode(',', $package->features);
//
//        // Check if the feature exists in the package's features field
//        return in_array($featureName, $packageFeatures);
//    }
//}
