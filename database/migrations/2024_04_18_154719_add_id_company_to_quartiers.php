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
        Schema::table('quartiers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger("id_company")->after("id_editor")->nullable();
            $table->foreign("id_company")->references("id")->on("users")->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quartiers', function (Blueprint $table) {
            //
        });
    }
};
