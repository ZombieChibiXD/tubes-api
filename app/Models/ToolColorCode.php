<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ToolColorCode",
 *     required={"code", "color"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool color code ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="Tool color code",
 *         example="R"
 *     ),
 *     @OA\Property(
 *         property="color",
 *         type="string",
 *         description="Tool color code color",
 *         example="#FF0000"
 *     ),
 *     @OA\Property(
 *         property="text_color",
 *         type="string",
 *         description="Tool text color code",
 *         example="#FF0000"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Tool color code created at",
 *         example="2021-03-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Tool color code updated at",
 *         example="2021-03-01 00:00:00"
 *     )
 * )
 */
class ToolColorCode extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'code',
        'color',
        'text_color',
    ];

    /**
     * Get the tool items for the tool color code.
     */
    public function toolItems()
    {
        return $this->hasMany(ToolItem::class);
    }
}
