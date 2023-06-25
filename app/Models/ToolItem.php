<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    /**
     * Get all MachiningProject that owns the tool item.
     */
    public function machiningProjects()
    {
        return $this->hasMany(MachiningProject::class);
    }

    /**
     * Scope a query to only include is_active type of a given type within machinig projects.
     */
    public function scopeProject(Builder $query, $filter = null)
    {
        // If filter is "CLEAN" then return only tool items that have no machining projects
        if ($filter == 'CLEAN') {
            $query->whereDoesntHave('machiningProjects');
            return;
        }
        $query->whereHas('machiningProjects', function ($query) use ($filter) {
            switch ($filter) {
                case 'NEW':
                case 'USED':
                    $query->where('is_active', false);
                    break;
                case 'ACTIVE':
                    $query->where('is_active', true);
                    break;
                case 'HISTORY':
                default:
                    break;
            }
        });
        if ($filter == 'NEW') {
            $query->orWhereDoesntHave('machiningProjects');
        }
    }
}
