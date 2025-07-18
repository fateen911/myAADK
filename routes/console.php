<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('program:update-status')->everyMinute();
Schedule::command('users:freeze-inactive')->daily();
Schedule::command('send:program-invitations')->dailyAt('10:00');
Schedule::command('klien:relaps')->daily();

