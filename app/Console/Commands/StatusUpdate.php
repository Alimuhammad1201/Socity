<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sadmin\NOCS;
use Illuminate\Support\Carbon;
class StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Nocs:status-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check NOC expiry dates and update status to Expired if necessary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now()->toDateString(); // 'Y-m-d' format
        $nocs = NOCS::where('status', '!=', 'Expired')->get();

        foreach ($nocs as $row) {
            $expdate = Carbon::parse($row->valid_until);
            
            if ($expdate->lessThan($currentDate)) { // Check if expiry date is less than the current date
                if ($row->status == 'Active') {
                    NOCS::where('id', $row->id)->update(['status' => 'Expired']);
                }
            }
            \Log::info($row);
}

    }
}
