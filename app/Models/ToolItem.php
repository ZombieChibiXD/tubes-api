<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="ToolItem",
 *     required={"tool_product_id", "item_code"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool item ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_product_id",
 *         type="integer",
 *         description="Tool product ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="item_code",
 *         type="string",
 *         description="Tool item code",
 *         example="TI-001"
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
class ToolItem extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'tool_product_id',
        'item_code'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            /**
             * @var ToolItemSequence $sequence
             */
            $sequence = ToolItemSequence::firstOrCreate([
                'tool_product_id' => $model->tool_product_id
            ]);
            if (!$model->item_code) {
                $model->item_code = $sequence->getNextValue();
            } elseif ($sequence->next_value < $model->item_code) {
                $sequence->next_value = $model->item_code + 1;
                $sequence->save();
            }
        });
    }

    public function toolProduct()
    {
        return $this->belongsTo(ToolProduct::class);
    }
}
