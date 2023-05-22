<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerListing extends Model
{
    use HasFactory;

    public function scopeCountry(Builder $query, $country): Builder
    {
        return $query->whereHas('country', function (Builder $query) use ($country) {
            $query->where('name', $country);
        });
    }

    public function scopePosition(Builder $query, $position): Builder
    {
        return $query->whereHas('position', function (Builder $query) use ($position) {
            $query->where('name', $position);
        });
    }

    public function scopeMarketPrice(Builder $query, $market_price): Builder
    {
        return $query->where('market_price', $market_price);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);

    }
}
