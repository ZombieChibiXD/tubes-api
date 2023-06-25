<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="MachiningProject",
 *     required={"tool_item_id",
 *               "workpiece_material", "machining_process", "cutting_speed",
 *               "depth_of_cut", "feeding", "early_tool_life", "is_active"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Machining project ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_item_id",
 *         type="integer",
 *         description="Tool item ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="workpiece_material",
 *         type="string",
 *         description="Workpiece material",
 *         example="Carbon steel"
 *     ),
 *     @OA\Property(
 *         property="machining_process",
 *         type="string",
 *         description="Machining process",
 *         example="Turning"
 *     ),
 *     @OA\Property(
 *         property="cutting_speed",
 *         type="integer",
 *         description="Cutting speed (m/min)",
 *         example=100
 *     ),
 *     @OA\Property(
 *         property="depth_of_cut",
 *         type="integer",
 *         description="Depth of cut (mm)",
 *         example=50
 *     ),
 *     @OA\Property(
 *         property="feeding",
 *         type="integer",
 *         description="Feeding (mm/r)",
 *         example=100
 *     ),
 *     @OA\Property(
 *         property="early_tool_life",
 *         type="integer",
 *         description="Early tool life (minute)",
 *         example=100
 *     ),
 *     @OA\Property(
 *         property="is_active",
 *         type="boolean",
 *         description="Is active",
 *         example=true
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
 * )
 */
class MachiningProject extends Model
{
    use HasFactory, HasTimestamps;

    const TABLE = 'machining_projects';
    protected $table = self::TABLE;

    /*
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'tool_item_id',
        'workpiece_material',
        'machining_process',
        'cutting_speed',
        'depth_of_cut',
        'feeding',
        'early_tool_life',
        'is_active',
    ];
    
    /**
     * The attributes that should be appended.
     */
    protected $appends = ['remaining_time'];
    
    public function toolItem()
    {
        return $this->belongsTo(ToolItem::class);
    }

    public function machiningProjectWorks()
    {
        return $this->hasMany(MachiningProjectWork::class);
    }

    // Remaining time is calculated by subtracting the machining time of each
    // work from the early tool life of the machining project.
    public function getRemainingTimeAttribute()
    {
        $remainingTime = $this->early_tool_life;
        foreach ($this->machiningProjectWorks as $work) {
            $remainingTime -= $work->machining_time;
        }
        return $remainingTime;
    }

}
