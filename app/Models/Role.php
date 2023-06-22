<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Role",
 *     required={"id", "name", "created_at", "updated_at"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Role ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Role name",
 *         example="admin"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of role creation",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of last role update",
 *         example="2020-01-01 00:00:00"
 *     )
 * )
 */
class Role extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];


    /**
     * Get the users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, UserRole::TABLE);
    }
}
