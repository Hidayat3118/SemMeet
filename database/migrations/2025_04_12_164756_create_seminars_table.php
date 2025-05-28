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
        // 14 atribut id dan timestamps tidak di hitung
        Schema::create('seminars', function (Blueprint $table) {
            $table->id();  
            $table->string('foto')->nullable(); 
            $table->enum('mode', ['online', 'offline']);
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable(); 
            $table->decimal('harga', 10, 2); 
            $table->enum('status', ['draft', 'aktif', 'selesai']);     
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable(); 
            $table->string('metting_link')->nullable();
            $table->integer('kouta'); 
            $table->foreignId('keuangan_id')->constrained()->onDelete('cascade');
            $table->foreignId('panitia_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('moderator_id')->constrained()->onDelete('cascade');
            $table->foreignId('pembicara_id')->constrained()->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
            $table->timestamps();
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
