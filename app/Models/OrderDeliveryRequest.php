<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDeliveryRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderDelivery(): HasOne
    {
        return $this->HasOne(OrderDelivery::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
