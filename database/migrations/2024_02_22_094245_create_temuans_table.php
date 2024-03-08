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
        Schema::create('temuans', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi_temuan');
            $table->string('lokasi');
            $table->string('img_url');
            $table->foreignId('pelaksana_mod')->constrained('teams', 'id');
            $table->foreignId('tim')->constrained('teams', 'id');
            $table->string('usulan');
            $table->foreignId('pic')->constrained('departements', 'id');
            $table->foreignId('tindakan_status_id')->nullable()->constrained('tindakans', 'id');
            $table->foreignId('tindakan_img_url_id')->nullable()->constrained('tindakans', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuans');
    }
};
