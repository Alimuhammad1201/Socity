<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Sadmin\Packages;
use App\Models\Sadmin\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'stripeToken' => 'required',
//            'package_id' => 'required|exists:packages,id',
        ]);

        Stripe::setApiKey('sk_test_51NdVnELfxADWNbsjsO0W87PrQWAAARv6TOcPemXujCbvAb2bRBsCONMOEudUbSFsCJtGJHmdruNkaD8OXM2uYOz200PHl8teWp');

        $package = Packages::find($request->package_id);

        try {
            $charge = \Stripe\Charge::create([
               'amount' => $package->price * 100,
               'currency' => 'usd',
               'source' => $request->stripeToken,
               'description' => "Subscription TO". $package->package_name,
            ]);
//            dd($charge);

            $user = User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
            ]);

            Subscription::create([
                'user_id' => $user->id,
                'package_type' => $package->id,
                'start_date' => now(),
                'end_date' => now()->addDays($package->duration),
                'status' => 'Active',
                'payment_type' => 'Stripe',
                'transaction_id' => $charge->id,
                'payment_method' => $charge->payment_method_details->type ?? 'card',
                'price' => $charge->amount / 100,
            ]);

            return redirect()->route('/')->with('success', 'Successfully Subscription');
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
