<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class CreateProjectYougile implements ShouldQueue
{
    use Queueable;
//    protected $apiKey;
//    protected $apiToken;
protected string $title;
    /**
     * Create a new job instance.
     */
    public function __construct(string $title)
    {
//        $this->apiKey = $apiKey;
//        $this->apiToken = $apiToken;
        $this->title = $title;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = config('services.yougile.api_key');   // Ключ API из config/services.php или .env
        $apiToken = config('services.yougile.api_token');
        $url = 'https://yougile.com/api-v2/projects';

        $response = Http::withHeaders([
            'X-API-KEY' => $apiKey,
            'Authorization' => 'Bearer ' . $apiToken,
            'Content-Type' => 'application/json',
        ])->post($url, [
            'title' => $this->title,
            // Добавьте другие обязательные поля, если нужно
        ]);

    }
}
