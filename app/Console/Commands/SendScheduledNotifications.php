<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sadmin\Notification;
use App\Services\NotificationService;

class SendScheduledNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled notifications';


    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the current time
        $now = now();

        // Fetch notifications that need to be sent
        $notifications = Notification::where('sent_at', '<=', $now)
            ->whereNull('sent_at')
            ->get();

        foreach ($notifications as $notification) {
            $notificationService = new NotificationService();

            // Send notification based on the 'sent_via' field
            if ($notification->sent_via === 'SMS') {
                $notificationService->sendSms($notification->allotment->OwnerContactNumber, $notification->message);
            } elseif ($notification->sent_via === 'WhatsApp') {
                $notificationService->sendWhatsApp($notification->allotment->OwnerContactNumber, $notification->message);
            } elseif ($notification->sent_via === 'Email') {
                $notificationService->sendEmail($notification->allotment->OwnerEmail, 'Notification', $notification->message);
            }

            // Mark the notification as sent
            $notification->update(['sent_at' => now()]);
        }

        $this->info('Scheduled notifications sent successfully!');
    }
}
