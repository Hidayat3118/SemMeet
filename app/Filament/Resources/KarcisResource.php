<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KarcisResource\Pages;
use App\Models\Karcis;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class KarcisResource extends Resource
{
    protected static ?string $model = Karcis::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKarcis::route('/'),
            'create' => Pages\CreateKarcis::route('/create'),
            'edit' => Pages\EditKarcis::route('/{record}/edit'),
        ];
    }
}
