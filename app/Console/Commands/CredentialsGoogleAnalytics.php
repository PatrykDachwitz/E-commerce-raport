<?php
declare(strict_types=1);
namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\This;
use stdClass;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CredentialsGoogleAnalytics extends Command
{
    const URL_TOKEN_API_GOOGLE = "https://oauth2.googleapis.com/token";
    const URL_AUTH_API_GOOGLE = "https://accounts.google.com/o/oauth2/v2/auth";
    protected string $credentialsPath, $tokenPath;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    public function __construct()
    {
        parent::__construct();

        $this->credentialsPath = config('api.pathGoogleCredentials');
        $this->tokenPath = config('api.pathGoogleToken');
    }

    protected $signature = 'google-auth:analytics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First token configuration and acceptance of Google resources for Data API.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->credentialsFileIsset()) return false;

        echo __('command.useUrlInBrowse');
        echo "\n" . $this->getUrlAccessCodeForToken();

        $codeAuth = text(__('command.giveCodeAccess'));

        if (!$this->saveTokenFile($codeAuth)) {
            $this->fail(__('command.notSavedToken'));
        } else {
            echo __("command.saveToken");
        }
    }

    protected function getRedirectUrl() {
        return $this->getDataCredentials()
            ->redirect_uris[0];
    }
    protected function saveTokenFile($codeAuh) : bool|int {
        $accessTokenResponse = $this->downloadAccessToken($codeAuh);

        return file_put_contents($this->tokenPath, $accessTokenResponse);
    }
    protected function buildParams($codeAuth) : string {
        $params = "code={$codeAuth}";
        $params .= "&client_id=" . $this->getClientId();
        $params .= "&redirect_uri=" . $this->getRedirectUrl();
        $params .= "&grant_type=authorization_code";
        $params .= "&client_secret=" . $this->getClientSecret();

        return $params;
    }

    protected function downloadAccessToken($codeAuth) : string {
        $params = $this->buildParams($codeAuth);

        $ch = curl_init(self::URL_TOKEN_API_GOOGLE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return ($response);
    }

    protected function getUrlAccessCodeForToken() : string {
        $url = self::URL_AUTH_API_GOOGLE;
        $url .= "?client_id=" . $this->getClientId();
        $url .= "&redirect_uri=" . $this->getRedirectUrl();
        $url .= "&response_type=code";
        $url .= "&prompt=consent&access_type=offline";
        $url .= "&scope=https://www.googleapis.com/auth/analytics.readonly+https://www.googleapis.com/auth/analytics";

        return $url;
    }

    protected function getClientSecret() : string {
        return $this->getDataCredentials()
            ->client_secret;
    }
    protected function getClientId() : string {
        return $this->getDataCredentials()
            ->client_id;
    }

    protected function getDataCredentials() : stdClass {
        $contentFile = file_get_contents($this->credentialsPath);

        return  json_decode($contentFile)->web;
    }
    protected function credentialsFileIsset() : bool {

        if (file_exists($this->credentialsPath)) {
            return true;
        } else {
            echo __('command.fileNotIsset');
            return false;
        }

    }

}
