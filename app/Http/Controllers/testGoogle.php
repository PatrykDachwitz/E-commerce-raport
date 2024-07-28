<?php

namespace App\Http\Controllers;

use App\Services\Adwords\AnalyticsApi;
use Illuminate\Support\Facades\Http;

class testGoogle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AnalyticsApi $request)
    {
        $url = "https://oauth2.googleapis.com/token";
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
        ])
            ->withBody(json_encode($this->buildParams()))
            ->post($url);

        dd($response->json());
    }
    protected function getDataCredentials() {
        $contentFile = file_get_contents(config('api.pathGoogleAdwordsCredentials'));

        return  json_decode($contentFile)->web;
    }
    protected function getClientSecret() : string {
        return $this->getDataCredentials()
            ->client_secret;
    }
    protected function getClientId() : string {
        return $this->getDataCredentials()
            ->client_id;
    }

    protected function buildParams() {
        return [
            "grant_type" => "refresh_token",
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "refresh_token" => "1//09VoLqiN0LbItCgYIARAAGAkSNwF-L9IrhkX8AhGlfDsCx0a1LqQPgsAZE4DAyxeYgO1oibfZ_kjBGse_yg9cGo7r6oMDxgm6bBs",
        ];
    }

}

