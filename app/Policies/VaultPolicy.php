<?php

namespace App\Policies;

use App\Http\Middleware\AdminCheck;
use App\Models\User;
use App\Models\Vault;
use Illuminate\Auth\Access\HandlesAuthorization;

class VaultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->role == User::ROLE_ROOT || $user->role == User::ROLE_ADMIN) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return mixed
     */
    public function view(User $user, Vault $vault)
    {
        if(!$user->vaults->contains($vault)){
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return mixed
     */
    public function update(User $user, Vault $vault)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return mixed
     */
    public function delete(User $user, Vault $vault)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return mixed
     */
    public function restore(User $user, Vault $vault)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Vault  $vault
     * @return mixed
     */
    public function forceDelete(User $user, Vault $vault)
    {
        return true;
    }
}
