<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function orderLines(): HasMany
    {
        return $this->HasMany(OrderLine::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'restaurant_id');
    }
}
