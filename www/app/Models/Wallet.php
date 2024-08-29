<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'balance',
    ];

    /**
     * Transform value to persist/retrive
     */
    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => round($value, 2) * 100,
        );
    }

    /**
     * Get owner of wallet
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
