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
        Schema::create('recepts', function (Blueprint $table) {
            $table->id();
            $table->string("nom_vet");
            $table->string("color_vet");
            $table->string("caract_vet");
            $table->integer("qte_vet");
            $table->integer("prix_unitaire");
            $table->integer("prix");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepts');
    }
};
