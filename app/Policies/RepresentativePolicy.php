<?php

namespace App\Policies;

use App\Models\Representative;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RepresentativePolicy
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

        return $user->can('list representative');
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

        return $user->can('show representative');
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

        return $user->can('create representative');
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

        return $user->can('update representative');
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
        
        return $user->can('delete representative');
    }
}
