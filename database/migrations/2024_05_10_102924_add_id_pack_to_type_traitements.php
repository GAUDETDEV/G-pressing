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
        Schema::table('type_traitements', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_pack")->after("id_gerant")->nullable();
            $table->foreign("id_pack")->references("id")->on("packs")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_traitements', function (Blueprint $table) {
            //
        });
    }
};
