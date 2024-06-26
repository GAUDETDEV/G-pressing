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
        Schema::create('type_traitements', function (Blueprint $table) {
            $table->id();
            $table->string("type_traitement")->nullable();
            $table->text("description_traitement")->nullable();
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
        Schema::dropIfExists('type_traitements');
    }
};
