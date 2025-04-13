<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
require_once __DIR__ . '/../../../vendor/autoload.php';

class TestMailController
{
    public static function send($msg) : void
    {
        echo 'test1';

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage($msg);
        $channel->basic_publish($msg, '', 'hello');


        $channel->close();
        $connection->close();


    }

    public function receive()
    {

        echo 'start';

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $callback = function ($msg) {
            $userId = $msg->body;
            $user = User::query()->find($userId);
            print_r($user->email);

            $email = $user->email;
            Mail::to($email)->send(new TestMail());

        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo 'false';
            echo $exception->getMessage();
        }

    }
}
