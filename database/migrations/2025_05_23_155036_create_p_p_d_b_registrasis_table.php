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
        Schema::create('p_p_d_b_registrasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto_pendaftar');
            $table->string('email')->nullable();
            $table->string('no_telp',20)->nullable();
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('asal_sekolah_sebelumnya');
            $table->date('tgl_pendaftaran');
            $table->enum('status',['Ditolak','Tertunda','Disetujui']);
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
        Schema::dropIfExists('p_p_d_b_registrasis');
    }
};
