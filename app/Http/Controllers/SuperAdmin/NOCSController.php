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
        $noc = NOCS::with(['block', 'flatArea'])->get();
        return view('superadmin.Nocs.index', compact('noc'));
    }

    public function create()
    {
        $latestNocs = DB::table('noc')->latest('id')->first();
        if($latestNocs){
            $latestNumber = (int) substr($latestNocs->noc_number, 4);
            $nextNumber = $latestNumber + 1;
        }else{
            $nextNumber = 1;
        }
        $nocNumber = 'NOC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        session(['noc_number' => $nocNumber]);
        $block = Block::get();
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

        // Debugging the validated data
        NOCS::create([
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
        $noc = NOCS::findOrFail($id);
        $block = Block::get();
        return view('superadmin.Nocs.edit', compact('block', 'noc'));
    }

    public function show($id)
    {
        $nocData = NOCS::with(['block', 'flatArea'])->find($id); // Fetch NOC data based on ID
        return view('superadmin.Nocs.noc_certificate', compact('nocData'));
    }

    public function destroy($id)
    {
        $noc = NOCS::findOrFail($id);
        $noc->delete();
        return response()->json(['success' => true]);
    }

    public function checkAndUpdateStatus()
    {
        $nocs = NOCS::where('status', '!=', 'Expired')->get();
        foreach($nocs as $noc){
            if (Carbon::now()->greaterThanOrEqualTo(Carbon::parse($noc->valid_until))) {
                $noc->status = 'Expired';
                $noc->save;
            }

            return response()->json(['message' => 'Statuses updated successfully']);
        }
    }

    public function user_view_noc()
    {
        if(Auth::guard('flat_guard')->check()) {
            $user = Auth::guard('flat_guard')->user();


            $block = $user->block_id;
            $flat = $user->flat_id;

            $noc = NOCS::Where('block_id', $block,)->where('flat_id', $flat)->get();

        }

        return view('user.noc.view', compact('noc'));
    }


}
