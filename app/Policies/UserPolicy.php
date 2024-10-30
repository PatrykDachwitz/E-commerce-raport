<?php
declare(strict_types=1);
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    private User $user;
    public function __construct()
    {
    }

    /**
     * Determine whether the user can view any models.
     */

    public function checkSuperAdmin(User $user) : bool {
        return $user->super_admin;
    }


    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, user $model): bool
    {
        if ($user->super_admin === true || $user->id === $model->id) return true;
        else return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, user $model): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, user $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, user $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, user $model): bool
    {
        //
    }
}
