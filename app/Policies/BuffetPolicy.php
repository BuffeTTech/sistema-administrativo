<?php

namespace App\Policies;

use App\Models\Buffet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuffetPolicy
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

        return $user->can('list buffet');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Buffet $buffet): bool
    {   
        // se o usuário não estivr logado 
        if ($user === null) {
            return false;
        }

        return $user->can('show buffet');
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

        return $user->can('create buffet');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Buffet $buffet): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('update buffet');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Buffet $buffet): bool
    {
        // se usuario não estiver logado
        if ($user === null) {
            return false;
        }

        return $user->can('delete buffet');
    }
}
