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
    protected string $description;
    private YougileClient $yougileClient;
    /**
     * Create a new job instance.
     */
    public function __construct(int $orderId, string $description)
    {
        $this->orderId = $orderId;
        $this->description = $description;
        $this->yougileClient = new YougileClient();
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
            'description' => $this->description,
            'archived' => false,
            'completed' => false,
        ];

        $this->yougileClient->createTasks($data);
    }
}
