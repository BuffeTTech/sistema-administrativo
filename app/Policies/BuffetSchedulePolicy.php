<?php

namespace App\Policies;

use App\Models\BuffetSchedule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuffetSchedulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BuffetSchedule $buffetSchedule): bool
    {
        //
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
    public function update(User $user, BuffetSchedule $buffetSchedule): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BuffetSchedule $buffetSchedule): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BuffetSchedule $buffetSchedule): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BuffetSchedule $buffetSchedule): bool
    {
        //
    }
}
