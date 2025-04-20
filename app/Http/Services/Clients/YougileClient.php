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
        $this->apiKey = config('services.yougile.api_key');   // Ключ API из config/services.php или .env
        $this->apiToken = config('services.yougile.api_token');
        $this->baseUrl = 'https://yougile.com/api-v2/';
    }
    public function createTasks(array $data)
    {

//        $response = Http::withHeaders([
//            'X-API-KEY' => $this->apiKey,
//            'Authorization' => 'Bearer ' . $this->apiToken,
//            'Content-Type' => 'application/json',
//        ])->post($this->baseUrl.'tasks', $data);
//
//        // Обработка ответа
//        if ($response->successful()) {
//            $data = $response->json();
//            // Действия при успехе, например:
//            return 'true';
//        } else {
//            // Логирование или обработка ошибок
//            logger()->error('Yougile API error', ['response' => $response->body()]);
//        }

        $response = retry(3, function () use ($data)  {
            return Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl.'tasks', $data);
        });
    }

}
