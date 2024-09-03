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
        ->join('block', 'allotments_a.BlockNumber', '=', 'block.id')
        ->join('flat_area', 'allotments_a.FlatNumber', '=', 'flat_area.id')
        ->select(
            'block.Block_name',
            'flat_area.flat_no',
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
            'allotments_a.password'
        )
        ->where('allotments_a.FlatNumber', $user->flat_id) // Assuming `flat_id` is the correct column
        ->get();

    return view('user.dashboard', [
        'user' => $user,
        'allotments' => $allotments,
    ]);
} else {
    return redirect('/login');
}
    }
}
