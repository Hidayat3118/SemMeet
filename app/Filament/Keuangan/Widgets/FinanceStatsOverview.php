<?php

namespace App\Filament\Keuangan\Widgets;

use App\Models\Payment;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class FinanceStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Pembayaran Masuk', 'Rp. ' . number_format(Payment::where('status_pembayaran', 'completed')->sum('jumlah_pembayaran')))
                ->description('Total yang berhasil dibayar')
                ->color('success'),

            Card::make('Total Peserta', Peserta::count())
                ->description('Peserta terdaftar'),

            Card::make('Pendaftaran Pending', Pendaftaran::where('status', 'pending')->count())
                ->description('Menunggu pembayaran')
                ->color('warning'),
        ];
    }
}
