<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh seminar_id (pastikan ini cocok dengan id yang sudah ada di tabel seminars)
        $seminarId = 1;

        for ($i = 1; $i <= 10; $i++) {
            Voucher::create([
                'deskripsi' => 'Diskon voucher ke-' . $i,
                'code_voucher' => strtoupper(Str::random(12)),
                'tanggal_mulai' => Carbon::now()->subDays(rand(0, 10)),
                'tanggal_berakhir' => Carbon::now()->addDays(rand(5, 15)),
                'penggunaan_voucher' => rand(0, 3),
                'maksimal_pemakaian' => rand(5, 20),
                'diskon_harga' => rand(10000, 50000),
                'status' => 'active',
                'seminar_id' => $seminarId,
            ]);
        }
    }
}
