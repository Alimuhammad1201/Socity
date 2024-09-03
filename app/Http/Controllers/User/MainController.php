<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Sadmin\Allotment;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();
        
            // Perform the join query
          
            $allotments = DB::table('allotments_a')
            ->select(
                'flat_area.flat_no',
                'block.Block_name',
                'allotments_a.id',
                'allotments_a.OwnerName',
                'allotments_a.OwnerEmail',
                'allotments_a.nic',
                'allotments_a.OwnerContactNumber',
                'allotments_a.OwnerAlternateContactNumber',
                'allotments_a.OwnerMemberCount',
                'allotments_a.status',
                'allotments_a.date',
                'allotments_a.created_at',
                'allotments_a.updated_at',
                'allotments_a.password',
                'allotments_a.confirm_password',
                'allotments_a.BlockNumber'
            )
            ->join('block', 'allotments_a.BlockNumber', '=', 'block.id')
            ->join('flat_area', 'allotments_a.FlatNumber', '=', 'flat_area.id')
            ->where('allotments_a.FlatNumber', $user->FlatNumber)
            ->first();

            
        
       
        
            return view('user.dashboard', compact('user', 'allotments'));
        } else {
    return redirect('/login');
}
    }
}
