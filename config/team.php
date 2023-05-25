<?php

return [

    /**
     * The initial structure of a team when a new user is registered.
     *
     * This array contains key-value pairs where keys are the player positions and
     * values are the number of players of that position in a new team.
     *
     * 'GK' => Goalkeepers
     * 'DF' => Defenders
     * 'MF' => Midfielders
     * 'AT' => Attackers
     */
    'initial_schema' => [
        'GK' => 3,
        'DF' => 6,
        'MF' => 6,
        'AT' => 5,
    ],

    /**
     * Default balance of a new user's team.
     *
     * When a user signs up and a new team is created, this is the initial budget
     * for the team to buy players from the transfer market.
     */
    'default_balance' => 5000000,

    /**
     * Default value of a player.
     *
     * This is the market value of each player when they are initially added to
     * a new user's team.
     */
    'player_default_value' => 1000000,
];
