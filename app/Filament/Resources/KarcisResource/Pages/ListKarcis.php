<?php

namespace App\Filament\Resources\KarcisResource\Pages;

use App\Filament\Resources\KarcisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKarcis extends ListRecords
{
    protected static string $resource = KarcisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
