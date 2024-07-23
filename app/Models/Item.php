<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'item_category_id',
        'item_unit_type_id',
        'price',
        'description',
        'image',
        'stock',
    ];

    public function itemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function itemUnitType(): BelongsTo
    {
        return $this->belongsTo(ItemUnitType::class);
    }
}
