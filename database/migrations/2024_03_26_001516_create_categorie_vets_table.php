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
        Schema::create('categorie_vets', function (Blueprint $table) {
            $table->id();
            $table->string("nom_cat_vet")->nullable();
            $table->unsignedBigInteger("id_editor")->nullable();
            $table->foreign("id_editor")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_pack")->nullable();
            $table->foreign("id_pack")->references("id")->on("packs")->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_vets');
    }
};
