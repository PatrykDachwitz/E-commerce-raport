<?php
declare(strict_types=1);
namespace App\Repository\Eloquent;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryRepository implements \App\Repository\CountryRepository
{

    private Country $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    public function index(int $paginate = 15)
    {
        return $this->country
            ->paginate($paginate);
    }

    public function show(int $id): country
    {
        return $this->country
            ->findOrFail($id);
    }

    public function destroy(int $id)
    {
        return $this->country
            ->destroy($id);
    }
}
