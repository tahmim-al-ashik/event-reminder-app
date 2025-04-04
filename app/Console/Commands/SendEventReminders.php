<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Mail\EventReminderMail;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders';
    protected $description = 'Send email reminders for upcoming events';

    public function handle()
    {
        $now = now();
        $upcoming = Event::where('event_time', '>=', $now)
            ->where('event_time', '<=', $now->copy()->addMinutes(10)) // 10 mins range
            ->whereNotNull('email')
            ->get();

        foreach ($upcoming as $event) {
            Mail::to($event->email)->send(new EventReminderMail($event));
        }

        $this->info('Reminders sent for upcoming events.');
    }
}
