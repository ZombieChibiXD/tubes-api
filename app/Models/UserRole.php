<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    const TABLE = 'user_roles';
    protected $table = self::TABLE;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
