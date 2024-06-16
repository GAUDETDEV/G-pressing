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
        Schema::table('recepts', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_receptionist")->after("id_type_depot")->nullable();
            $table->foreign("id_receptionist")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recepts', function (Blueprint $table) {
            //
        });
    }
};
