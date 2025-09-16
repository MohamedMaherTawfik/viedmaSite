<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteExpiredUsers extends Command
{
    /**
     * اسم الكوماند اللي هتشغله.
     *
     * @var string
     */
    protected $signature = 'users:delete-expired';

    /**
     * وصف الكوماند.
     *
     * @var string
     */
    protected $description = 'Delete users whose OTP has expired and are not verified';

    /**
     * تنفيذ الكوماند.
     */
    public function handle()
    {
        $count = User::where('is_verified', false)
            ->whereNotNull('otp_expires_at')
            ->where('otp_expires_at', '<', now())
            ->delete();

        $this->info("Deleted {$count} expired users.");
    }
}