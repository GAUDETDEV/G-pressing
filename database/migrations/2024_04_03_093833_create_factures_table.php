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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string("nom_titulaire");
            $table->string("tel_titulaire");
            $table->unsignedBigInteger("id_type_depot")->nullable();
            $table->foreign("id_type_depot")->references('id')->on('depots')->cascadeOnDelete()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void

    {
        Schema::dropIfExists('factures');
    }

};
