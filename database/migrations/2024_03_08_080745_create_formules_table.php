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
        Schema::create('formules', function (Blueprint $table) {
            $table->id();
            $table->string('nom_formule');
            $table->float('prix_formule');
            $table->integer('nbr_user');
            $table->string('nbr_essai');
            $table->integer('periode');
            $table->longText('fonctionnalite');
            $table->unsignedBigInteger('id_etat_formule')->nullable();
            $table->foreign('id_etat_formule')->references('id')->on('etat_formules')->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formules');
    }
};
