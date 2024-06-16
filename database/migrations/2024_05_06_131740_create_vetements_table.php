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
        Schema::create('vetements', function (Blueprint $table) {
            $table->id();
            $table->string("nom_vet")->nullable();
            $table->float("prix_vet")->nullable();
            $table->unsignedBigInteger("id_cat_vet")->nullable();
            $table->foreign("id_cat_vet")->references("id")->on("categorie_vets")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_specification_vet")->nullable();
            $table->foreign("id_specification_vet")->references("id")->on("specification_vets")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_couleur_vet")->nullable();
            $table->foreign("id_couleur_vet")->references("id")->on("couleur_vets")->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vetements');
    }
};
