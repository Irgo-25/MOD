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
        Schema::table('tindakans', function (Blueprint $table) {
            $table->foreignId('temuan_id')->nullable()->constrained('temuans', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tindakans', function (Blueprint $table) {
            $table->foreignId('temuan_id')->nullable()->constrained('temuans', 'id');
        });
    }
};
