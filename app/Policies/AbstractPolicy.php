<?php

namespace App\Policies;


use App\Models\User;
use Illuminate\Support\Facades\Log;

abstract class AbstractPolicy
{
    
    abstract public function name();

    protected function isAdmin(User $user): bool
    {
        return $user->id;
    }
    protected function log($context, $user = null, $model = null)
    {
        Log::debug($this->name() . '::' . $context);
        if ($user) {
            Log::debug('User Details: ', ['user' => $user]);
        }
        if ($model) {
            Log::debug('Model Details: ', ['model' => $model]);
        }
    }
}
