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
        Schema::table('taches', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_create_tache")->after("id_facture")->nullable();
            $table->foreign("id_create_tache")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            //
        });
    }
};
