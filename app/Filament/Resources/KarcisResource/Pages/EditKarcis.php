<?php

namespace App\Filament\Resources\KarcisResource\Pages;

use App\Filament\Resources\KarcisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKarcis extends EditRecord
{
    protected static string $resource = KarcisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
