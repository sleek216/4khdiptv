<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Services\DatabaseExportService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendPeriodicDatabaseExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:database-email {--force : Force sending the export regardless of interval} {--email= : Send to a specific email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send automated database CSV export report to admin email periodically (every 30 days)';

    /**
     * Execute the console command.
     */
    public function handle(DatabaseExportService $exportService): int
    {
        $this->info('Starting database export process...');

        $enabled = Setting::get('backup_export_enabled', '1') === '1';
        $force = (bool) $this->option('force');
        $customEmail = $this->option('email');

        if (!$enabled && !$force && !$customEmail) {
            $this->warn('Periodic database export is currently disabled in Settings.');
            return self::SUCCESS;
        }

        $frequencyDays = (int) Setting::get('backup_export_frequency_days', '30');
        if ($frequencyDays < 1) {
            $frequencyDays = 30;
        }

        $lastSentAt = Setting::get('backup_export_last_sent_at');

        if (!$force && !$customEmail && $lastSentAt) {
            $lastSent = Carbon::parse($lastSentAt);
            $daysSinceLast = (int) $lastSent->diffInDays(now());

            if ($daysSinceLast < $frequencyDays) {
                $this->info("Last export was sent {$daysSinceLast} days ago ({$lastSentAt}). Next export is scheduled in " . ($frequencyDays - $daysSinceLast) . " days.");
                return self::SUCCESS;
            }
        }

        $targetEmail = $customEmail ?: Setting::get('backup_export_email');

        $this->info("Sending database CSV export...");
        $result = $exportService->sendExportToEmail($targetEmail);

        if ($result['success']) {
            $this->info("SUCCESS: {$result['message']}");
            return self::SUCCESS;
        }

        $this->error("FAILED: {$result['message']}");
        return self::FAILURE;
    }
}
