<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }

    public function orderDeliveries(): HasMany
    {
        return $this->hasMany(OrderDelivery::class);
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
