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
        Schema::table('specification_vets', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_editor")->after("nom_specification_vet")->nullable();
            $table->foreign("id_editor")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('specification_vets', function (Blueprint $table) {
            //
        });
    }
};
