<?php

namespace App\Policies;

use App\Models\ToolMaterial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToolMaterialPolicy extends AbstractPolicy
{
    public function name()
    {
        return 'ToolMaterialPolicy';
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
    public function view(User $user, ToolMaterial $toolMaterial): bool
    {
        $this->log('view', $user, $toolMaterial);
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
    public function update(User $user, ToolMaterial $toolMaterial): bool
    {
        $this->log('update', $user, $toolMaterial);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ToolMaterial $toolMaterial): bool
    {
        $this->log('delete', $user, $toolMaterial);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ToolMaterial $toolMaterial): bool
    {
        $this->log('restore', $user, $toolMaterial);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ToolMaterial $toolMaterial): bool
    {
        $this->log('forceDelete', $user, $toolMaterial);
        return $this->isAdmin($user);
    }
}
