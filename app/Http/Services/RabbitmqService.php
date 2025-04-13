<?php

namespace App\Http\Services;

use App\Mail\TestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitmqService
{
    public function produce(array $data, string $queueName)
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $data = json_encode($data);
        $msg = new AMQPMessage($data);
        $channel->basic_publish($msg, '', $queueName);

//
//        $channel->close();
//        $connection->close();
    }

    public function consume(string $queueName, callable $callback)
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo 'false';
            echo $exception->getMessage();
        }
    }

}
