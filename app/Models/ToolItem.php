<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="ToolItem",
 *     required={"tool_product_toolbox_id", "tool_color_code_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool item ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_product_toolbox_id",
 *         type="integer",
 *         description="Tool product toolbox ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_color_code_id",
 *         type="integer",
 *         description="Tool color code ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Tool item created at",
 *         example="2021-03-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Tool item updated at",
 *         example="2021-03-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="tool_product_toolbox",
 *         ref="#/components/schemas/ToolProductToolbox"
 *     ),
 *     @OA\Property(
 *         property="tool_color_code",
 *         ref="#/components/schemas/ToolColorCode"
 *     )
 * )
 */
class ToolItem extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'tool_product_toolbox_id',
        'tool_color_code_id'
    ];

    /**
     * Get the tool product toolbox that owns the tool item.
     */
    public function toolProductToolbox()
    {
        return $this->belongsTo(ToolProductToolbox::class);
    }
}
