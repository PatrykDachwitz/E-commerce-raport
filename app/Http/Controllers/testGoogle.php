<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\Adwords\AnalyticsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class testGoogle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AnalyticsApi $request)
    {

       /*Facebook  $idAccount = "458682306919668";

        $body = json_encode('
        {
        fields: "impressions",
        access_token: "EAAHCzEQqUY8BOZBsFQuO0ZACOIlibO1gl1KnyWqNmSRDhsZBjbeZBMRtE0D6W8dG6aJMGjlvMZAC49xK0ztsNUKD3ScyzXjnj1ey6WO12ZBblTIsSHH7h2Y14JZBK4thcu4VWhjH6LZBXu9yRKb5ShFVZA83WRaVZCxWkulejWDPb3BvoXn4HIDAwG44H6L16ZAQLHWnOnk1RzJ",
        level="ad"
        }
        ');

       $response = Http::withHeaders([
           "Content-Type" => "application/json",
           "Accept" => "application/json",
           "Authorization" => "Bearer EAAHCzEQqUY8BOZBsFQuO0ZACOIlibO1gl1KnyWqNmSRDhsZBjbeZBMRtE0D6W8dG6aJMGjlvMZAC49xK0ztsNUKD3ScyzXjnj1ey6WO12ZBblTIsSHH7h2Y14JZBK4thcu4VWhjH6LZBXu9yRKb5ShFVZA83WRaVZCxWkulejWDPb3BvoXn4HIDAwG44H6L16ZAQLHWnOnk1RzJ",
       ])
           ->withBody($body)
           ->get("https://graph.facebook.com/v20.0/act_{$idAccount}/insights");

       dd($response->json());*/

        $request->setCountry(Country::find(1));

    dd($request->connectApi("2024-06-12", "2024-06-16"));

    }
}

