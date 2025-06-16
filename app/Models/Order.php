<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'delivery_time' => 'datetime',
            'paid' => 'boolean',
        ];
    }

    public function orderLines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    protected $fillable = [
        'type',
        'name',
        'phone_number',
        'delivery_time',
        'table_number',
        'person_number',
        'comment',
        'total_price',
        'state',
        'paid',
    ];

}
