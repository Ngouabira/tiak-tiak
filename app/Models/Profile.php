<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed $validated)
 */
class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users(): HasMany
    {
        return $this->HasMany(User::class);
    }
}
