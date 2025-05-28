<?php

namespace App\Filament\Resources;

use App\Models\Karcis;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\KarcisResource\Pages;

class KarcisResource extends Resource
{
    protected static ?string $model = Karcis::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Kehadiran';
    protected static ?string $pluralLabel = 'Kehadiran';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // Tidak ada form karena create/edit dinonaktifkan
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('waktu_sqan')->label('Waktu Kehadiran')->dateTime(),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('pendaftaran.nama')->label('Nama Peserta'),
                TextColumn::make('pendaftaran.seminar.judul')
                    ->label('Seminar')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('seminar_id')
                    ->label('Pilih Seminar')
                    ->options(Seminar::all()->pluck('judul', 'id'))
                    ->searchable(),
            ])
            ->actions([
                // Tidak ada edit action karena dinonaktifkan
            ])
            ->bulkActions([
                // Tidak ada bulk action karena delete dinonaktifkan
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKarcis::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
