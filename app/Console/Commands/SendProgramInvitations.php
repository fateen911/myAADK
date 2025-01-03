<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Program;
use App\Models\Klien;
use App\Mail\HebahanMail;
use Illuminate\Support\Facades\Mail;

class SendProgramInvitations extends Command
{
    protected $signature = 'send:program-invitations';
    protected $description = 'Send program invitations for every 7 days.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get programs with status 'new' or 'postponed'
        $programs = Program::whereIn('status', ['BELUM SELESAI', 'PINDA'])
            ->where('tarikh_tamat', '>=', now()) // Ensure end date is in the future
            ->get();
        $currentDate = now();

        foreach ($programs as $program) {
            $startDate = Carbon::parse($program->tarikh_mula);
            $endDate = Carbon::parse($program->tarikh_tamat);
            $notifDate = $startDate->copy()->addDays(7);

            while ($notifDate <= $endDate){
                if ($notifDate->toDateString() == $currentDate->toDateString()){

                    // Send the email for each program to related clients
                    if ($program->negeri_pejabat == "semua" && $program->daerah_pejabat == "semua") {
                        $klien = Klien::whereNotNull('emel')->get();
                    }
                    elseif ($program->negeri_pejabat != "semua" && $program->daerah_pejabat == "semua") {
                        $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->whereNotNull('emel')->get();
                    }
                    else {
                        $klien = Klien::where('negeri_pejabat', $program->negeri_pejabat)->where('daerah_pejabat',$program->negeri_pejabat)->whereNotNull('emel')->get();
                    }

                    // Send communication based on the selected method
                    foreach ($klien as $item) {
                        if($item->emel != null){
                            $recipient = $item->emel;
                            Mail::to($recipient)->send(new HebahanMail($program->id));
                        }
                    }
                    $notifDate = $notifDate->addDays(7); //next notification
                }
                else{
                    $notifDate = $notifDate->addDays(7);
                }
            }

            $this->info('Invitation successfully sent');
        }
    }
}
