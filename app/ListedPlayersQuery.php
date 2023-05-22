<?php

namespace App;

use App\Models\PlayerListing;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListedPlayersQuery extends QueryBuilder
{
    public function __construct()
    {
        $playerListing = PlayerListing::query();
        parent::__construct($playerListing);
        $this->allowedSorts('created_at', 'updated_at', 'asking_price')
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::scope('country'),  // assuming there is a scope `country` in PlayerListing model
                AllowedFilter::scope('position'), // assuming there is a scope `position` in PlayerListing model
                AllowedFilter::exact('age'),
                AllowedFilter::scope('market_price'), // assuming there is a scope `market_price` in PlayerListing model
            ]);
    }
}
