<?php
// ini sqan
namespace App\Filament\Pages;

use Filament\Pages\Page;

class Kehadiran extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.sqan';

    protected static ?string $title = 'Sqan Code';

    protected static bool $shouldRegisterNavigation = true;
}
