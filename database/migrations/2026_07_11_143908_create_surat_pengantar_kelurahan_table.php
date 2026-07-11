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
        Schema::create('surat_pengantar_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rt_id')->constrained('ketua_rt')->onDelete('cascade');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->enum('bukti_diri', ['KTP', 'KK']);
            $table->string('nama_orang_tua');
            $table->text('maksud_keperluan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar_kelurahan');
    }
};
