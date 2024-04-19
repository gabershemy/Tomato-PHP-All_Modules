<?php

namespace Modules\TomatoNotifications\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Modules\TomatoNotifications\App\Mail\SendEmail;
use Modules\TomatoNotifications\App\Models\NotificationsLogs;

class NotifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ?string $email;
    public ?string $subject;
    public ?string $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($arrgs)
    {
        $this->email = $arrgs['email'];
        $this->subject = $arrgs['subject'];
        $this->message  = $arrgs['message'];
        $this->url  = $arrgs['url'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendEmail($this->message, $this->subject, $this->url));

        $log = new NotificationsLogs();
        $log->title = $this->subject;
        $log->description = $this->message;
        $log->provider = "email";
        $log->type = "info";
        $log->save();
    }
}
