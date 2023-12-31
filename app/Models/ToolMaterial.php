<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ToolMaterial",
 *     required={"name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool material ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Tool material name",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *       property="description",
 *       type="string",
 *       example="Karbida is a material used for tools",
 *       description="Description of the tool material"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of creation",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp of last update",
 *         example="2020-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="products",
 *         type="array",
 *         description="Tool products",
 *         @OA\Items(ref="#/components/schemas/ToolProduct")
 *     )
 * )
 */
class ToolMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    
    /**
     * Get the tool products for the material.
     */
    public function products()
    {
        return $this->hasMany(ToolProduct::class);
    }
}
