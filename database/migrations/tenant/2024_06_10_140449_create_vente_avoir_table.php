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
        Schema::create('vente_avoir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vente_id')->references('id')->on('ventes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('avoir_id')->references('id')->on('ventes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vente_avoir');
    }
};
