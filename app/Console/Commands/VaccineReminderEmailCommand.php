<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccineReminderEmail;

class VaccineReminderEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:vaccine-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send vaccine reminder email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereDate('scheduled_at', '=', now()->addDays(1))->get();

        if ($users->count()) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new VaccineReminderEmail($user));
            }
        }

        return 0;
    }
}
