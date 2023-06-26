<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * @OA\Schema(
 *     schema="ToolProductToolbox",
 *     required={"tool_product_id", "code"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Tool product toolbox ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tool_product_id",
 *         type="integer",
 *         description="Tool product ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="Tool product toolbox code",
 *         example="TP-001"
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
 *         property="tool_product",
 *         ref="#/components/schemas/ToolProduct",
 *         description="Tool product"
 *      ),
 *     @OA\Property(
 *         property="tool_items",
 *         type="array",
 *         @OA\Items(
 *             ref="#/components/schemas/ToolItem"
 *         ),
 *         description="Tool items"
 *      )
 * )
 */
class ToolProductToolbox extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'tool_product_id'
    ];

    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            /**
             * @var ToolItemSequence $sequence
             */
            $sequence = ToolProductToolboxSequence::firstOrCreate([
                'tool_product_id' => $model->tool_product_id
            ]);
            if (!$model->code) {
                $model->code = $sequence->getNextValue();
            } elseif ($sequence->next_value < $model->code) {
                $sequence->next_value = $model->code + 1;
                $sequence->save();
            }
        });
    }

    public function toolProduct()
    {
        return $this->belongsTo(ToolProduct::class);
    }

    public function toolItems()
    {
        return $this->hasMany(ToolItem::class);
    }

}
