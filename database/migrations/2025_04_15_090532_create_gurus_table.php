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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Magang', 'Cuti', 'Pensiun', 'Keluar', 'Dikeluarkan']);
            $table->enum('jabatan', ['Guru', 'Staff', 'Kepala Sekolah', 'Yayasan', 'Ketua Yayasan']);
            $table->string('nik')->nullable()->unique();
            $table->string('pendidikan');
            $table->string('mata_pelajaran')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat');
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
        Schema::dropIfExists('gurus');
    }
};
