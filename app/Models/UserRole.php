<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'role_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $dateFormat = 'Y-m-d H:i:s';
}
