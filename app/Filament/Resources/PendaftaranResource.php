<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pendaftaran;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Model; // Tambahkan import Model
use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

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
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'danger' => 'pain',
                        'success' => 'attenden',
                    ])
                    ->sortable(),

                TextColumn::make('voucher.nama') // asumsi relasi voucher punya kolom 'nama'
                    ->label('Voucher')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('seminar.judul') // asumsi relasi seminar punya kolom 'judul'
                    ->label('Seminar')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('peserta.nama') // asumsi relasi peserta punya kolom 'nama'
                    ->label('Peserta')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
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
            'index' => Pages\ListPendaftarans::route('/'),
        ];
    }

    // Menambahkan method untuk menghilangkan tombol "Create"
    public static function canCreate(): bool
    {
        return false;
    }

    // Menghilangkan tombol "Edit"
    public static function canEdit(Model $record): bool
    {
        return false;
    }

    // Menghilangkan tombol "Delete"
    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
