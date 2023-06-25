<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolProductToolboxSequence extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'tool_product_id',
        'next_value',
    ];

    public function toolProduct()
    {
        return $this->belongsTo(ToolProduct::class);
    }

    public function getNextValue()
    {
        $nextValue = $this->next_value;
        $this->next_value++;
        $this->save();
        return $nextValue;
    }
}
