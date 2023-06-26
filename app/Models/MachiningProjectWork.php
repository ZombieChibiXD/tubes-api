<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="MachiningProjectWork",
 *     required={"machining_project_id", "product_id", "initial_diameter",
 *          "final_diameter", "workpart_length", "product_quantity",
 *          "machining_time"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Machining project work ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="machining_project_id",
 *         type="integer",
 *         description="Machining project ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="product_id",
 *         type="string",
 *         description="Product ID",
 *         example="P0001"
 *     ),
 *     @OA\Property(
 *         property="initial_diameter",
 *         type="number",
 *         format="float",
 *         description="Initial diameter (mm)",
 *         example=100.0
 *     ),
 *     @OA\Property(
 *         property="final_diameter",
 *         type="number",
 *         format="float",
 *         description="Final diameter (mm)",
 *         example=50.0
 *     ),
 *     @OA\Property(
 *         property="workpart_length",
 *         type="number",
 *         format="float",
 *         description="Workpart length (mm)",
 *         example=100.0
 *     ),
 *     @OA\Property(
 *         property="machining_time",
 *         type="integer",
 *         description="Machining time (min)",
 *         example=10
 *     ),
 *     @OA\Property(
 *         property="product_quantity",
 *         type="integer",
 *         description="Product quantity",
 *         example=10
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation date",
 *         example="2021-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update date",
 *         example="2021-01-01 00:00:00"
 *     )
 * ) 
 */
class MachiningProjectWork extends Model
{
    use HasFactory, HasTimestamps;

    /**
     * Toucheable attributes
     */
    protected $touches = ['machiningProject'];
    protected $appends = ['total_machining_time'];
    protected $fillable = [
        'machining_project_id',
        'product_id',
        'initial_diameter',
        'final_diameter',
        'workpart_length',
        'product_quantity',
        'machining_time',
    ];

    public function machiningProject()
    {
        return $this->belongsTo(MachiningProject::class);
    }
    public function getTotalMachiningTimeAttribute()
    {
        return $this->machining_time * $this->product_quantity;
    }
}
