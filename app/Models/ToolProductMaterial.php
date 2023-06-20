<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ToolProductMaterial extends Pivot
{
    const TABLE = 'tool_product_material';
    protected $table = self::TABLE;
    
    protected $fillable = [
        'tool_product_id',
        'tool_material_id',
    ];
    
}
