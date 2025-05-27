<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Karcis;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\KarcisResource\Pages;


class KarcisResource extends Resource
{
    protected static ?string $model = Karcis::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kehadiran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextColumn::make('qr_code')->label('QR Code'),
                TextColumn::make('waktu_sqan')->label('Waktu Scan')->dateTime(),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('pendaftaran.nama')->label('Nama Peserta'), // sesuaikan relasi jika ada
                TextColumn::make('pendaftaran.seminar.judul')
                    ->label('Seminar')
                    ->sortable()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                SelectFilter::make('seminar_id')
                    ->label('Pilih Seminar')
                    ->options(Seminar::all()->pluck('judul', 'id'))
                    ->searchable(),
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
