<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FreezeInactiveUsers extends Command
{
    protected $signature = 'users:freeze-inactive';
    protected $description = 'Freeze accounts of users inactive for more than 3 months';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Calculate the date 3 months ago
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // Find users who have been inactive for more than 3 months
        $inactiveUsers = User::where('last_active_at', '<', $threeMonthsAgo)
            ->orWhereNull('last_active_at') // Never active users
            ->where('acc_status', 'ACTIVE') // Only active users
            ->get();

        foreach ($inactiveUsers as $user) {
            // Freeze the user's account by updating their status
            $user->update(['acc_status' => 'FROZEN']);

            // Log output
            $this->info("User {$user->name} has been frozen due to inactivity.");
        }

    }
}
