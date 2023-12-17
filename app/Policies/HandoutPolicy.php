<?php

namespace App\Policies;

use App\Models\Handout;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HandoutPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('list handout');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('show handout');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }
        return $user->can('create handout');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }
        return $user->can('update handout');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('delete handout');
    }
}
