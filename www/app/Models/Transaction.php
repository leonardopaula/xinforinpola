<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payer_id',
        'payer_balance',
        'payee_id',
        'payee_balance',
        'value',
        'success',
        'message',
    ];

    /**
     * Transform value to persist/retrive
     */
    protected function payer_balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => round($value, 2) * 100,
        );
    }

    /**
     * Transform value to persist/retrive
     */
    protected function payee_balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => round($value, 2) * 100,
        );
    }

    /**
     * Transform value to persist/retrive
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => round($value, 2) * 100,
        );
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'success' => 'boolean',
    ];


    /**
     * Get owner of wallet
     */
    public function payee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'payee_id');
    }

    /**
     * Get owner of wallet
     */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'payer_id');
    }
}
