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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string("nom_destinataire");
            $table->integer("tel_destinataire");
            $table->date("date_livraison");
            $table->time("heure_livraison");
            $table->unsignedBigInteger("id_commune")->nullable();
            $table->foreign("id_commune")->references("id")->on("communes")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_quartier")->nullable();
            $table->foreign("id_quartier")->references("id")->on("quartiers")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_adresse")->nullable();
            $table->foreign("id_adresse")->references("id")->on("adresses")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_prix")->nullable();
            $table->foreign("id_prix")->references("id")->on("prices")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_facture")->nullable();
            $table->foreign("id_facture")->references("id")->on("factures")->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
