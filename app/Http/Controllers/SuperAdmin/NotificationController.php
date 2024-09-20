<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\sadmin\Allotment;
use App\Models\Sadmin\Notification;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;


class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $notifications = Notification::with('allotment')->get();
        return view('superadmin.notification.index',compact('notifications'));
    }

    public function create()
    {
        $allotments = Allotment::get();
        return view('superadmin.notification.create', compact('allotments'));
    }

    public function store(Request $request)
    {
//        dd('request all ',$request->all());
        $request->validate([
            'allotment_id' => 'required',
            'message' => 'required',
            'sent_via' => 'required',
            'sent_at' => 'required',
        ]);

        $allotment = Allotment::find($request['allotment_id']);
        if (!$allotment) {
            return response()->json(['error', 'allotment not found'], 404);
        }

        try {
            if ($request['sent_via'] === 'SMS') {
                $this->notificationService->sendSms($allotment->OwnerContactNumber, $request['message']);
            } elseif ($request['sent_via'] === 'WhatsApp') {
                $this->notificationService->sendWhatsApp($allotment->OwnerContactNumber, $request['message']);
//                        dd($this->notificationService->sendWhatsApp($allotment->OwnerContactNumber, $request['message']));
            } elseif ($request['sent_via'] === 'Email') {
                $this->notificationService->sendEmail($allotment->OwnerEmail, 'Notification', $request['message']);
            }
        } catch (\Exception $e) {
            Log::error('Notification Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send notification'], 500);
        }


        Notification::create([
            'allotment_id' => $request['allotment_id'],
            'message' => $request['message'],
            'sent_via' => $request['sent_via'],
            'sent_at' => $request['sent_at']
        ]);
        return redirect()->route('notification.index');
//        return response()->json(['status' => 'SMS Sent Successfully'], 200);
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
