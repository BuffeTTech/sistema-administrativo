<?php

namespace App\Policies;

use App\Models\Commercial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommercialPolicy
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

        return $user->can('list commercial');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Commercial $commercial): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('show commercial');
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

        return $user->can('create commercial');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Commercial $commercial): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('update commercial');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Commercial $commercial): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        } 
        
        return $user->can('delete commercial');
    }
}
