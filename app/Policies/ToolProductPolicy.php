<?php

namespace App\Policies;

use App\Models\ToolProduct;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToolProductPolicy extends AbstractPolicy
{
    public function name()
    {
        return 'ToolProductPolicy';
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $this->log('viewAny', $user);
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ToolProduct $toolProduct): bool
    {
        $this->log('view', $user, $toolProduct);
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $this->log('create', $user);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ToolProduct $toolProduct): bool
    {
        $this->log('update', $user, $toolProduct);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ToolProduct $toolProduct): bool
    {
        $this->log('delete', $user, $toolProduct);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ToolProduct $toolProduct): bool
    {
        $this->log('restore', $user, $toolProduct);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ToolProduct $toolProduct): bool
    {
        $this->log('forceDelete', $user, $toolProduct);
        return $this->isAdmin($user);
    }
}
