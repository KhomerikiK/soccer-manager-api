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
        Schema::create('player_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Team::class);
            $table->foreignIdFor(\App\Models\Player::class);
            $table->bigInteger('asking_price');
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_listings');
    }
};
