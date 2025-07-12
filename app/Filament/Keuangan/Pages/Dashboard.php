<?php

namespace App\Filament\Keuangan\Pages;

use App\Filament\Keuangan\Widgets\FinanceStatsOverview;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $slug = ''; // supaya halaman utama = /keuangan

    
    public function getWidgets(): array
    {
        return [
            FinanceStatsOverview::class,
        ];
    }

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Select::make('seminar_id')
                ->label('Filter Seminar')
                ->options(Seminar::pluck('judul', 'id'))
                ->searchable()
                ->placeholder('Semua seminar')
                ->live() // Tambahkan ini untuk real-time update
                ->afterStateUpdated(function () {
                    // Refresh widgets setelah filter berubah
                    $this->dispatch('$refresh');
                }),
        ]);
    }

    // Override method ini untuk memastikan filters diteruskan ke widgets
    public function getWidgetData(): array
    {
        return array_merge(
            parent::getWidgetData(),
            [
                'filters' => $this->filters,
            ]
        );
    }
}
