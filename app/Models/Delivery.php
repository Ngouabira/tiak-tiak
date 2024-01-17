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

    public function deliveryRequest(): HasMany
    {
        return $this->hasMany(DeliveryRequest::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function deliver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deliver_id');
    }
}
