<?php

namespace App\Policies;

use App\Models\User;
use App\Models\formationQual;
use Illuminate\Auth\Access\Response;

class formationQualifiantePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, formationQual $formationQual): bool
    {
        return  $user->id === $formationQual->user;
    
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, formationQual $formationQual): bool
    {
        return $user->id === $formationQual->user;
    
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, formationQual $formationQual): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, formationQual $formationQual): bool
    {
        return false;
    }
}
