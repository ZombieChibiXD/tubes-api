<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\Pivot;
/**
 * @OA\Schema(
 *     schema="ToolProductMaterial",
 *     required={"tool_product_id", "tool_material_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool product material ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_product_id",
 *         type="integer",
 *         description="Tool product ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_material_id",
 *         type="integer",
 *         description="Tool material ID",
 *         example=1
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
class ToolProductMaterial extends Pivot
{
    use HasTimestamps;
    const TABLE = 'tool_product_material';
    protected $table = self::TABLE;
    
    protected $fillable = [
        'tool_product_id',
        'tool_material_id',
    ];
    
    protected $casts = [
        'id' => 'integer'
    ];
    
}
