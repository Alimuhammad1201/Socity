<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\NOCS;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Sadmin\Block;
use PhpOffice\PhpWord\TemplateProcessor;

class NOCSController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $noc = collect();
        if ($buildingAdmin) {
            $noc = NOCS::where('building_admin_id', $buildingAdmin->id)->with(['block', 'flatArea'])->get();
        } else {
            $noc = NOCS::where('user_id', $userId)->with(['block', 'flatArea'])->get();
        }

//        $noc = NOCS::where('user_id',auth()->id())->with(['block', 'flatArea'])->get();
        return view('superadmin.Nocs.index', compact('noc'));
    }

    public function create()
    {
        $userId = auth()->id();
        $buildingAdmin = auth()->guard('building_admin')->user();

        $latestNocs = collect();
        if ($buildingAdmin) {
            $latestNocs = NOCS::latest('id')->where('building_admin_id', $buildingAdmin->id)->first();
        } else {
            $latestNocs = NOCS::latest('id')->where('user_id', $userId)->first();
        }

//        $latestNocs = DB::table('noc')->latest('id')->where('user_id',auth()->id())->first();
        if ($latestNocs) {
            $latestNumber = (int)substr($latestNocs->noc_number, 4);
            $nextNumber = $latestNumber + 1;
        } else {
            $nextNumber = 1;
        }
        $nocNumber = 'NOC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        session(['noc_number' => $nocNumber]);
        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.Nocs.create', compact('block'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'noc_number' => 'required',
            'name' => 'required|string',
            'block' => 'required|exists:block,id',
            'flat_no' => 'required|exists:flat_area,id',
            'issue_date' => 'required|date',
            'valid_until' => 'date',
            'purpose' => 'required|string',
            'status' => 'required|string',
        ]);
        $userId = null;
        if (auth()->user()) {
            $userId = auth()->user()->id;
        } elseif (auth()->guard('building_admin')->check()) {

            $buildingAdmin = auth()->guard('building_admin')->user();
            $userId = $buildingAdmin->user_id;
        }
        // Debugging the validated data
        NOCS::create([
            'user_id' => $userId,
            'building_admin_id' => auth()->guard('building_admin')->id(),
            'noc_number' => $request->noc_number,
            'name' => $request->name,
            'block_id' => $request->block,
            'flat_id' => $request->flat_no,
            'issue_date' => $request->issue_date,
            'valid_until' => $request->valid_until,
            'purpose' => $request->purpose,
            'status' => $request->status,
        ]);

        return redirect()->route('nocs.index');
    }

    public function edit($id)
    {
        $noc = NOCS::where('user_id',auth()->id())->findOrFail($id);
        $block = Block::where('user_id',auth()->id())->get();
        return view('superadmin.Nocs.edit', compact('block', 'noc'));
    }

    public function show($id)
    {
        $nocData = NOCS::where('user_id',auth()->id())->with(['block', 'flatArea'])->find($id); // Fetch NOC data based on ID
        return view('superadmin.Nocs.noc_certificate', compact('nocData'));
    }

    public function destroy($id)
    {
        $noc = NOCS::where('user_id',auth()->id())->findOrFail($id);
        $noc->delete();
        return response()->json(['success' => true]);
    }

    public function checkAndUpdateStatus()
    {
        $nocs = NOCS::where('status', '!=', 'Expired')->where('user_id',auth()->id())->get();
        foreach ($nocs as $noc) {
            if (Carbon::now()->greaterThanOrEqualTo(Carbon::parse($noc->valid_until))) {
                $noc->status = 'Expired';
                $noc->save;
            }

            return response()->json(['message' => 'Statuses updated successfully']);
        }
    }

    public function user_view_noc()
    {
        if (Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();


            $block = $user->block_id;
            $flat = $user->flat_id;

            $noc = NOCS::where('user_id',auth()->id())->Where('block_id', $block,)->where('flat_id', $flat)->get();

        }

        return view('user.noc.view', compact('noc'));
    }


}
