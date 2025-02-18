<?php
declare(strict_types=1);
namespace App\Services\Connection;

use Illuminate\Support\Facades\Http;

trait GoogleRefreshToken
{
    private string $urlRefreshToken;
    private string $credentialsConfigName, $tokenConfigName;

    public function getAccessToken(string $credentialsConfigName, string $tokenConfigName) : string {
        $this->urlRefreshToken = config('api.endPointGoogleRefreshToken');
        $this->credentialsConfigName = $credentialsConfigName;
        $this->tokenConfigName = $tokenConfigName;

        return $this->connectApiToToken();
    }
    protected function connectApiToToken() : string {
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
        ])
            ->withBody(json_encode($this->getBody()))
            ->post($this->urlRefreshToken);

        if ($response->ok()) {
            return $response->json('access_token');
        } else {
            return "";
        }
    }
    protected function getClientSecret() : string {
        return $this->getDataCredentials()
            ->client_secret;
    }
    protected function getClientId() : string {
        return $this->getDataCredentials()
            ->client_id;
    }
    protected function getRefreshToken() : string {
        return $this->getDataToken()
            ->refresh_token;
    }
    protected function getDataCredentials() {
        $contentFile = file_get_contents(config($this->credentialsConfigName));

        return  json_decode($contentFile)->web;
    }
    protected function getDataToken() {
        $contentFile = file_get_contents(config($this->tokenConfigName));

        return  json_decode($contentFile);
    }
    protected function getBody() : array {
        return [
            "grant_type" => "refresh_token",
            "client_id" => $this->getClientId(),
            "client_secret" => $this->getClientSecret(),
            "refresh_token" => $this->getRefreshToken(),
        ];
    }

}
