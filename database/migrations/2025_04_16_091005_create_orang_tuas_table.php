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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ayah');
            $table->string('tempat_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ayah');
            $table->enum('jenis_kelamin_ayah',['Laki-laki']);
            $table->enum('agama_ayah', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('pendidikan_terakhir_ayah',['SD','SMP','SMA','SMK','D1','D2','D3','D4','S1','S2','S3']);
            $table->string('pekerjaan_ayah');
            $table->string('nomor_telepon_ayah')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat_ayah');
            $table->string('nama_ibu');
            $table->string('tempat_lahir_ibu')->nullable();
            $table->date('tanggal_lahir_ibu');
            $table->enum('agama_ibu', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('jenis_kelamin_ibu',['Perempuan']);
            $table->enum('pendidikan_terakhir_ibu',['SD','SMP','SMA','SMK','D1','D2','D3','D4','S1','S2','S3']);
            $table->string('pekerjaan_ibu');
            $table->string('nomor_telepon_ibu')->nullable();
            $table->string('email1')->nullable();
            $table->text('alamat_ibu');
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
        Schema::dropIfExists('orang_tuas');
    }
};
