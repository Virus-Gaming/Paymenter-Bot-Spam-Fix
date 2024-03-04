<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountDeletionNotice;

class DeleteBots extends Command
{
    protected $signature = 'user:deletebots';
    protected $description = 'Deletes users with numeric-only first names and notifies them via email.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch users with numeric-only first names
        $users = User::whereRaw("first_name REGEXP '^[0-9]+$'")->get();

        foreach ($users as $user) {
            // Send notification email
            Mail::to($user->email)->send(new AccountDeletionNotice($user));

            // Delete the user account
            // Consider implementing soft deletes to preserve data integrity
            $user->delete();

            $this->info("Deleted user with numeric first name: {$user->first_name}");
        }

        $this->info("Completed deleting users with numeric-only first names.");
    }
}
