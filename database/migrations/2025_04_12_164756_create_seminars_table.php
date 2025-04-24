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
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('mode', ['online', 'offline']);
            $table->string('judul');
            $table->text('deskripsi'); 
            $table->decimal('harga', 10, 2); 
            $table->date('tanggal');
            $table->enum('status', ['draft', 'aktif', 'selesai']);     
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->decimal('harga', 10, 2); 
            $table->string('lokasi'); 
            $table->integer('kouta'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
