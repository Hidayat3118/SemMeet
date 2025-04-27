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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi');
            $table->char('code_voucher')->unique();
            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_berakhir')->nullable();
            $table->integer('penggunaan_voucher');
            $table->integer('maksimal_pemakaian');
            $table->integer('diskon_harga')->default(0);
            $table->integer('diskon_persen');
            $table->enum('status', ['active', 'expired', 'used'])->default('active');
            $table->foreignId('seminar_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
