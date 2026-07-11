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
        Schema::create('ketua_rt', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('no_whatsapp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketua_rt');
    }
};
