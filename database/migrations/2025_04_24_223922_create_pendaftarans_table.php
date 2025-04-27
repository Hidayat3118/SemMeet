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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->enum('status', ['pending', 'pain', 'attenden']);
            $table->foreignId('voucher_id')->constrained()->onDelete('cascade');
            $table->foreignId('seminar_id')->constrained()->onDelete('cascade');
            $table->foreignId('peserta_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
