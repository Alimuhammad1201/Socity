<?php

namespace App\Console\Commands;

use App\Models\Sadmin\Subscription;
use App\Notifications\SubscriptionExpiryNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RenewSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:renew';
    protected $description = 'Renew subscriptions that are about to expire';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = Subscription::where('end_date', '<=', Carbon::now()->addDays(3))
            ->where('status', 'active')
            ->get();

        foreach ($subscriptions as $subscription) {
            // Send notification
            $subscription->user->notify(new SubscriptionExpiryNotification());
        }

        $this->info('Notifications sent for subscriptions about to expire.');
    }
}
