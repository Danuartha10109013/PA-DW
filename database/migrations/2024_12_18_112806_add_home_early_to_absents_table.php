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
            $table->string('home_early')->nullable()->after('status_absent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absents', function (Blueprint $table) {
            $table->dropColumn('home_early');
        });
    }
};
