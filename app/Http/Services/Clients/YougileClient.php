<?php

namespace App\Http\Services\Clients;

use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Facades\Http;

class YougileClient
{
    private string $apiKey;
    private string $apiToken;
    private string $baseUrl;

    public function __construct(){
        $this->apiKey = config('services.yougile.api_key');
        $this->apiToken = config('services.yougile.api_token');
        $this->baseUrl = config('services.yougile.base_url');
    }
    public function createTasks(array $data)
    {
        $response = retry(3, function () use ($data)  {
            return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'tasks', $data);
        });
    }

}
