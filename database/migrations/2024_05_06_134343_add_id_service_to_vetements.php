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
            $table->unsignedBigInteger("id_service")->after("id_editor")->nullable();
            $table->foreign("id_service")->references("id")->on("services")->cascadeOnDelete()->cascadeOnDelete();
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
