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
            $table->unsignedBigInteger("id_facture")->after('prix')->nullable();
            $table->foreign("id_facture")->references('id')->on('factures')->cascadeOnDelete()->cascadeOnDelete();
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
