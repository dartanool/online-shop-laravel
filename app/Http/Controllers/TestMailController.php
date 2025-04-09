<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class TestMailController
{
    public function send()
    {
        Mail::to('dartanool2003@gmail.com')->send(new TestMail());

        echo 'done';
    }
}
