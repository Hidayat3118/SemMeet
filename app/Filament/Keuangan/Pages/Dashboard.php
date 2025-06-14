<?php

namespace App\Filament\Keuangan\Pages;
use App\Filament\Keuangan\Widgets\FinanceStatsOverview;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.keuangan.pages.dashboard';

    public static function getWidgets(): array
    {
        return [
            FinanceStatsOverview::class,
        ];
    }
}
