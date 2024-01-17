<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function deliver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deliver_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
