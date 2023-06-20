<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ToolProduct",
 *     required={"code", "min_cutting_speed", "max_cutting_speed"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool product ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="Tool product code",
 *         example="TP-001"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Karbida",
 *         description="Tool product name"
 *     ),
 *     @OA\Property(
 *         property="min_cutting_speed",
 *         type="integer",
 *         example=100,
 *         description="Minimum cutting speed (m/min)"
 *     ),
 *     @OA\Property(
 *         property="max_cutting_speed",
 *         type="integer",
 *         example=100,
 *         description="Maximum cutting speed (m/min)"
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
 *     )
 * )
 */
class ToolProduct extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'code',
        'name',
        'min_cutting_speed',
        'max_cutting_speed',
    ];
    

    /**
     * Get the materials for the tool product.
     */
    public function materials()
    {
        return $this->belongsToMany(ToolMaterial::class, ToolProductMaterial::TABLE);
    }

    /**
     * Get the items for the tool product.
     */
    public function items()
    {
        return $this->hasMany(ToolItem::class);
    }
}
