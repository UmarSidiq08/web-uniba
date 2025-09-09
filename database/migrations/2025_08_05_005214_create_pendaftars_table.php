<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beasiswa_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nim');
            $table->string('email');
            $table->string('no_hp');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->integer('semester');
            $table->decimal('ipk', 3, 2);
            $table->text('alasan_mendaftar');
            $table->string('file_transkrip')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('file_kk')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftars');
    }
};