<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class YougileCreateProject implements ShouldQueue
{
    use Queueable;
    protected $apiKey;
    protected $apiToken;
    /**
     * Create a new job instance.
     */
    public function __construct(string $apiKey, string $apiToken)
    {
        $this->apiKey = $apiKey;
        $this->apiToken = $apiToken;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client([
            'base_uri' => 'https://api.yougile.com/v2/',
            'headers' => [
                'X-API-KEY' => $this->apiKey,
                'X-API-TOKEN' => $this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
