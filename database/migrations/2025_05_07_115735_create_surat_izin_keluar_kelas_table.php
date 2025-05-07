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
        Schema::create('surat_izin_keluar_kelas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat');
            $table->string('kepada_yth');
            $table->string('nama');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->integer('jam_ke');
            $table->text('pesan_keluar_kelas');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('disetujui');
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
        Schema::dropIfExists('surat_izin_keluar_kelas');
    }
};
