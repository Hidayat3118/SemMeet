<?php

namespace App\Filament\Keuangan\Widgets;

use App\Models\Payment;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Seminar;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Livewire\Attributes\On;

class FinanceStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    // Tambahkan property untuk menerima filters
    public ?array $filters = [];

    
    protected function getCards(): array
    {
        // Ambil seminar_id dari filters
        $seminarId = $this->filters['seminar_id'] ?? null;

      
        return [
            Card::make(
                'Total Pembayaran Masuk',
                'Rp. ' . number_format($this->getTotalPembayaran($seminarId))
            )
                ->description('Total yang berhasil dibayar')
                ->color('success'),

            Card::make(
                'Total Peserta',
                $this->getTotalPeserta($seminarId)
            )
                ->description('Peserta terdaftar')
                ->color('primary'),

            Card::make(
                'Pendaftaran Pending',
                $this->getTotalPendaftaranPending($seminarId)
            )
                ->description('Menunggu pembayaran')
                ->color('warning'),
        ];
    }

    private function getTotalPembayaran(?int $seminarId): int
    {
        $query = Payment::where('status_pembayaran', 'completed');

        if ($seminarId) {
            // Payment -> Pendaftaran -> Seminar
            $query->whereHas('pendaftaran', function ($q) use ($seminarId) {
                $q->where('seminar_id', $seminarId);
            });
        }

        return $query->sum('jumlah_pembayaran');
    }

    private function getTotalPeserta(?int $seminarId): int
    {
   
        $query = Pendaftaran::whereIn('status', ['paid', 'attended']);

        if ($seminarId) {
            $query->where('seminar_id', $seminarId);
        }

        return $query->count();
    }

    private function getTotalPendaftaranPending(?int $seminarId): int
    {
        $query = Pendaftaran::where('status', 'pending');

        if ($seminarId) {
            $query->where('seminar_id', $seminarId);
        }

        return $query->count();
    }
}
