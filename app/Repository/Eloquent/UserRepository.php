<?php
declare(strict_types=1);
namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserRepository implements \App\Repository\UserRepository
{

    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $data)
    {
        return $this->user
            ->create($data);
    }

    public function index()
    {
        return $this->user
            ->get();
    }

    public function destroy(int $id)
    {
        return $this->user
            ->destroy($id);
    }

    public function show(int $id)
    {
        return $this->user
            ->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->user
            ->where('id', $id)
            ->update($data);
    }

    public function setSuperAdmin(int $id, bool $superAdmin) {
        $user = $this->user->findOrFail($id);
        $user->super_admin = $superAdmin;

        return $user->save();
    }
}
