<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function delivery(): BelongsTo
    {
        return $this->BelongsTo(Delivery::class);
    }

    public function deliver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deliver_id');
    }
}
