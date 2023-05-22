<?php

namespace App\Http\Controllers\TransferMarket;

use App\Http\Controllers\Controller;
use App\ListedPlayersQuery;
use Illuminate\Http\Response;

class GetMarketDataController extends Controller
{
    public function __invoke(): Response
    {
        $marketData = new ListedPlayersQuery();

        return $this->ok($marketData->get());
    }
}
