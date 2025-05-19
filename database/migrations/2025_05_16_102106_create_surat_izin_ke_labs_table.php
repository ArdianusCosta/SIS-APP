<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izin_ke_labs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penanggung_jawab');
            $table->date('tanggal_izin');
            $table->date('tanggal_selesai');
            $table->string('kepada_yth');
            $table->string('nama');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->time('jam_ke');
            $table->time('sampai_jam');
            $table->text('pesan_keluar_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_izin_ke_labs');
    }
};
