<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get users of type
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get operations of type
     */
    public function operations(): HasMany
    {
        return $this->hasMany(TypeOperation::class);
    }
}
