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
        Schema::table('absents', function (Blueprint $table) {
            // $table->string('bukti_absent')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absents', function (Blueprint $table) {
            // $table->dropColumn('bukti_absent');
            $table->dropColumn('alamat');
        });
    }
};
