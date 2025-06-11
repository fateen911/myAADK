<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\viewklienlocal;
use App\Models\KlienView;
use Illuminate\Support\Facades\App;

class KlienRelapsCommand extends Command
{
    protected $signature = 'klien:relaps';
    protected $description = 'Check and freeze user accounts if not found in KlienView';

    public function handle()
    {
        $users = User::where('tahap_pengguna', 2)->get();

        foreach ($users as $user) {
            $no_kp = $user->no_kp;

            if (App::environment('local')) {
                //LOCAL
                $klienData = viewklienlocal::where('mykad', $no_kp)->first();
            } else {
                //SERVER
                $klienData = KlienView::where('mykad', $no_kp)->first();
            }

            if (!$klienData) {
                $user->update([
                    'acc_status' => 'DIBEKUKAN',
                    'updated_at' => now(),
                ]);

                $this->info("User {$user->id} dibekukan.");
            }
            else{
                $user->update([
                    'acc_status' => 'AKTIF',
                    'updated_at' => now(),
                ]);

                $this->info("User {$user->id} diaktifkan.");
            }
        }

        $this->info('KlienRelapsCommand selesai.');
    }
}

