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
        Schema::table('ppdb_registrasi', function (Blueprint $table) {
            $table->string('nisn')->unique()->after('nama');
            $table->string('nik')->unique()->after('nisn');
            $table->string('tempat_lahir')->after('no_telp');
            $table->string('nama_ayah')->after('asal_sekolah_sebelumnya');
            $table->string('nama_ibu')->after('nama_ayah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ppdb_registrasi', function (Blueprint $table) {
            $table->dropColumn('nisn');
            $table->dropColumn('nik');
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('nama_ayah');
            $table->dropColumn('nama_ibu');
        });
    }
};
