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
        Schema::create('quality_vetements', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->nullable();
            $table->text("description_quality")->nullable();
            $table->unsignedBigInteger("id_gerant")->nullable();
            $table->foreign("id_gerant")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_vetements');
    }
};
