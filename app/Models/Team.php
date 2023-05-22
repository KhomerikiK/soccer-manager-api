<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'country_id',
        'balance',
    ];

    public array $translatable = ['name'];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->orderByDesc('id');
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class)
            ->wherePivot('is_active', true)
            ->withPivot('is_active');
    }

    public function playerListings(): HasMany
    {
        return $this->hasMany(PlayerListing::class);
    }

    public function checkBalance(int $amount): bool
    {
        return $this->balance >= $amount;
    }
}
