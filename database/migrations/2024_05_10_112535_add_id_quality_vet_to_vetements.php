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
        Schema::table('vetements', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_quality_vet")->after("id_pack")->nullable();
            $table->foreign("id_quality_vet")->references("id")->on("quality_vetements")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vetements', function (Blueprint $table) {
            //
        });
    }
};
