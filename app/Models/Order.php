<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderDelivery(): HasOne
    {
        return $this->HasOne(OrderDelivery::class);
    }

    public function orderLines(): HasMany
    {
        return $this->HasMany(OrderLine::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'restaurant_id');
    }
}
