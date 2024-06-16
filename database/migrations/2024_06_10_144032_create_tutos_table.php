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
        Schema::create('tutos', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->string('description')->nullable();
            $table->string('video')->nullable();
            $table->string('lecteur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutos');
    }
};
