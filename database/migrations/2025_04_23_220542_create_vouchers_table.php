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
            $table->timestamps('tanggal_mulai');
            $table->timestamps('tanggal_berakhir');
            $table->integer('penggunaan_voucher');
            $table->integer('maksimal_pemakaian');
            $table->integer('diskon_harga')->default(0);
            $table->integer('diskon_persen');
            $table->enum('status', ['active', 'expired', 'used'])->default('active');
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
