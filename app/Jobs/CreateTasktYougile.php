<?php

namespace App\Jobs;

use App\Http\Services\Clients\YougileClient;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class CreateTasktYougile implements ShouldQueue
{
    use Queueable;
//    protected $apiKey;
//    protected $apiToken;
    protected string $orderId;
    protected array $description;
    /**
     * Create a new job instance.
     */
    public function __construct(int $orderId, array $description)
    {
//        $this->apiKey = $apiKey;
//        $this->apiToken = $apiToken;
        $this->orderId = $orderId;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $columnId = '6c0ae682-407c-4f2f-b468-c20b31782832';

        $data = [
            'title' => "Order # $this->orderId",
            'columnId' => $columnId,
            'description' => 'orders',
            'archived' => false,
            'completed' => false,
            'subtasks' => [$this->description],
        ];

        $res = new YougileClient();
        $res->createTasks($data);
    }
}
