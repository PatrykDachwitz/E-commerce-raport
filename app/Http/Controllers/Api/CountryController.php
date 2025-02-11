<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CountryController extends Controller
{
    const FILLABLE_INPUTS = [
        "name",
        "google",
        "shop",
        "facebook",
        "analytics",
        "active",
        "facebook_daily_budget",
        "google_daily_budget",
        "facebook_budget_currency",
        "google_budget_currency",
        "result-summary",
        "google_additional_campaign",
    ];
    private CountryRepository $countryRepository;
    /**
     * Display a listing of the resource.
     */

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        return $this->countryRepository
            ->index(20);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if(Gate::denies('checkSuperAdmin', Auth::user())) abort(403);

        return response([
            'data' => $this->countryRepository
            ->create($request->only(self::FILLABLE_INPUTS))
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response([
            'data' => $this->countryRepository
            ->show($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if(Gate::denies('checkSuperAdmin', Auth::user())) abort(403);

        return $this->countryRepository
            ->destroy($id);
    }
}
