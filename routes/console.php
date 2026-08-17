<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Periodic 30-Day Database Backup & Export Email
Schedule::command('export:database-email')->daily();

// Daily Check for Subscriptions Expiring in 3 Days (Admin Notification)
Schedule::command('subscriptions:check-expiring')->daily();
