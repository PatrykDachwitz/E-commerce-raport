<?php

namespace App\Http\Controllers;

use App\Services\Adwords\AnalyticsApi;
use App\Services\Adwords\GoogleAdwordsApi;
use Illuminate\Support\Facades\Http;

class testGoogle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GoogleAdwordsApi $adwordsApi)
    {

        return view('login');
    }

}

