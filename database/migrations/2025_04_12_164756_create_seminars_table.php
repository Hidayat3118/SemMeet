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
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable(); 
            $table->decimal('harga', 10, 2)->nullable(); 
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable(); 
            $table->enum('status', ['draft', 'aktif', 'selesai'])->nullable();     
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
