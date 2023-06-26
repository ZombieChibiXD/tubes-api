<?php

namespace App\Models;

// For verification, use this:
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="User",
 *     required={"id", "name", "email", "email_verified_at", "created_at", "updated_at"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="User ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="User's full name",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="User's email address",
 *         example="email@example.com"
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of email verification",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of user creation",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of last user update",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *       property="roles",
 *       type="array",
 *       description="User roles",
 *       @OA\Items(
 *         type="object",
 *         ref="#/components/schemas/Role"
 *       )
 *     ),
 *     @OA\Property(
 *       property="roles_names",
 *       type="array",
 *       description="User roles names",
 *       @OA\Items(
 *         type="string",
 *         example="admin"
 *       )
 *     ),
 * ),
 * @OA\Schema(
 *     schema="NewAccessToken",
 *     title="New Access Token",
 *     description="Schema for a new access token response",
 *     @OA\Property(
 *         property="accessToken",
 *         type="object",
 *         description="Access token details",
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Token name",
 *             example="authToken"
 *         ),
 *         @OA\Property(
 *             property="abilities",
 *             type="array",
 *             description="Token abilities",
 *             @OA\Items(
 *                 type="string",
 *                 example="ADMINISTRATOR"
 *             )
 *         ),
 *         @OA\Property(
 *             property="expires_at",
 *             type="string",
 *             format="date-time",
 *             description="Token expiration date",
 *             example="2023-06-19T15:36:53.000000Z"
 *         ),
 *         @OA\Property(
 *             property="tokenable_id",
 *             type="integer",
 *             description="Tokenable ID",
 *             example=1
 *         ),
 *         @OA\Property(
 *             property="tokenable_type",
 *             type="string",
 *             description="Tokenable type",
 *             example="App\\Models\\User"
 *         ),
 *         @OA\Property(
 *             property="updated_at",
 *             type="string",
 *             format="date-time",
 *             description="Updated at date",
 *             example="2023-06-19T14:36:53.000000Z"
 *         ),
 *         @OA\Property(
 *             property="created_at",
 *             type="string",
 *             format="date-time",
 *             description="Created at date",
 *             example="2023-06-19T14:36:53.000000Z"
 *         ),
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Token ID",
 *             example=2
 *         )
 *     ),
 *     @OA\Property(
 *         property="plainTextToken",
 *         type="string",
 *         description="Plain text token",
 *         example="2|QXOTSMko3kTiuZfd5YHxoBh3wwO5ywvER7ZThyWu"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be appended.
     */
    protected $appends = [
        'role_names', 'role_ids',
    ];

    /**
     * Get the roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, UserRole::TABLE);
    }

    /**
     * Find out if user has a specific role.
     */
    public function hasRole(string $role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Get role names of the user.
     */
    public function getRoleNames()
    {
        return $this->roles()->orderBy('name')->pluck('name')->toArray();
    }

    /**
     * Get role names of the user.
     */
    public function getRoleNamesAttribute()
    {
        return $this->getRoleNames();
    }
    /**
     * Get role Ids of the user.
     */
    public function getRoleIdsAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    }
}
