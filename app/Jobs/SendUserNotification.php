<?php

namespace App\Jobs;

use App\Mail\TestMail;
use App\Mail\UserNotificationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendUserNotification implements ShouldQueue
{

    use InteractsWithQueue, Queueable, SerializesModels;

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
        print_r('1'.$this->user->email); //Эти данные выводит
        print_r('2'.$this->user->name); //Эти данные выводит

        Mail::to($this->user->email)->send(new UserNotificationMail($this->user));
//        Mail::to('a1@gmail.com')->send(new TestMail());
    }
}
