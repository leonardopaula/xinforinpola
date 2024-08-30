<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeOperation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payer_type_id',
        'payee_type_id',
        'enabled',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * Get users of type
     */
    public function payerType(): BelongsTo
    {
        return $this->belongsToy(UserType::class);
    }

    /**
     * Get users of type
     */
    public function payeeType(): BelongsTo
    {
        return $this->belongsToy(UserType::class);
    }
}
