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
            $table->foreignId('pj_id')->constrained('penanggung_jawabs', 'id');
            $table->string('usulan');
            $table->string('tanggapan_pj');
            $table->foreignId('departement_id')->constrained('departements', 'id');
            $table->dateTime('jadwal_penyelesaian');
            $table->dateTime('rencana_perbaikan');
            $table->foreignId('tindakan_status_id')->constrained('tindakans', 'id');
            $table->foreignId('tindakan_img_url_id')->constrained('tindakans', 'id');
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
