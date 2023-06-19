<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    private function isAdmin(User $user): bool
    {
        return $user->id;
    }

    private function log(string $context, User $user): void
    {
        Log::debug('UserPolicy::' . $context);
        Log::debug('User Details: ', ['user' => $user]);
    }
    private function logModel(string $context, User $user, User $model): void
    {
        $this->log($context, $user);
        Log::debug('Model Details: ', ['model' => $model]);
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $this->log('viewAny', $user);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        $this->logModel('view', $user, $model);
        return $this->isAdmin($user);
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
    public function update(User $user, User $model): bool
    {
        $this->logModel('update', $user, $model);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $this->logModel('delete', $user, $model);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        $this->logModel('restore', $user, $model);
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        $this->logModel('forceDelete', $user, $model);
        return $this->isAdmin($user);
    }
}
