<?php
declare(strict_types=1);
namespace App\Repository;

interface UserRepository
{
    public function store(array $data);

    public function index();

    public function destroy(int $id);

    public function show(int $id);

    public function update(int $id, array $data);

    public function setSuperAdmin(int $id, bool $superAdmin);
}
