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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string("etat_tache")->nullable();
            $table->date("debut_tache")->nullable();
            $table->date("fin_tache")->nullable();
            $table->unsignedBigInteger("id_executant")->nullable();
            $table->foreign("id_executant")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
            $table->unsignedBigInteger("id_facture")->nullable();
            $table->foreign("id_facture")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
