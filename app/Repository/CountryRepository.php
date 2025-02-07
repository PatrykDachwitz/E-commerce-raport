<?php
declare(strict_types=1);
namespace App\Repository;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

interface CountryRepository
{

    public function index(int $paginate = 15);

    public function show(int $id) : country;

    public function destroy(int $id);
}
