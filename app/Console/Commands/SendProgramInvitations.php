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
    protected $description = 'Send program invitations 7 days before event start.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch programs starting 7 days from now
        $programs = Program::whereDate('tarikh_mula', now()->addDays(7)->toDateString())->get();

        foreach ($programs as $program) {

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
        }
        $this->info('Invitation successfully sent');
    }
}
