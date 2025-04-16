<?php

namespace App\Jobs;

use App\Mail\UserNotificationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;


class SendUserNotification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        print_r('1'.$this->user->email);
        print_r('2'.$this->user->name);
        Mail::to($this->user->email)->send(new UserNotificationMail($this->user->name));
    }
}
