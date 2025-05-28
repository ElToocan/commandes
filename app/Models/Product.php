<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public function productCategories(): BelongsTo
    {
        return $this->belongsTo(ProductCategories::class);
    }

    public function orderLine(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

}
