<?php
declare(strict_types=1);
namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface CountryRepository
{

    public function index(int $paginate = 15);
}
