<?php
declare(strict_types=1);
namespace App\Repository;

interface UserRepository
{
    public function store(array $data);

    public function index();

    public function destroy(int $id);
}
