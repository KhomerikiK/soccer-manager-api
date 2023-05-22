<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Player extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'market_price',
        'position_id',
        'country_id',
    ];

    protected $with = ['position', 'country'];

    public array $translatable = ['first_name', 'last_name'];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withPivot('is_active');
    }

    public function currentTeam()
    {
        return $this->teams()->wherePivot('is_active', true)->first();
    }

    public function playerListings(): HasMany
    {
        return $this->hasMany(PlayerListing::class);
    }
}
