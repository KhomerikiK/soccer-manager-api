<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Position::class);
            $table->foreignIdFor(\App\Models\Country::class);
            $table->json('first_name');
            $table->json('last_name');
            $table->smallInteger('age');
            $table->bigInteger('market_price')->comment('price in base units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
