<?php

namespace App\Console\Commands;

use App\Models\Program;
use Illuminate\Console\Command;

class KemaskiniStatusProg extends Command
{
    protected $signature = 'program:update-status';
    protected $description = 'Update the program status based on the current time';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Your logic to update the program status
        $currentTime = now();
        $program_mula = Program::where('tarikh_mula', '>=', $currentTime)
            ->where('status', '=', 'BELUM SELESAI')
            ->get();

        $program_tamat = Program::where('tarikh_tamat', '<', $currentTime)
            ->where('status', '=', 'SEDANG BERLANGSUNG')
            ->get();

        foreach ($program_mula as $program) {
            $program->status = 'SEDANG BERLANGSUNG';
            $program->save();
        }

        foreach ($program_tamat as $program) {
            $program->status = 'SELESAI';
            $program->save();
        }

        $this->info('Program statuses updated successfully!');
    }


}
