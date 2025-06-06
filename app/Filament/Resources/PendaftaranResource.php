<?php

namespace App\Filament\Resources;

use App\Models\Pendaftaran;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\PendaftaranResource\Pages;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Jika perlu form, isi di sini
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('peserta.user.name')
                    ->label('Peserta')
                    ->searchable(),

                TextColumn::make('seminar.judul')
                    ->label('Seminar')
                    ->searchable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'danger' => 'pain',
                        'success' => 'attenden',
                    ]),

                TextColumn::make('voucher.nama')
                    ->label('Voucher')
                    ->searchable()
                    ->toggleable(),



                TextColumn::make('created_at')
                    ->label('Waktu Pendaftaran')
                    ->dateTime(),

                // TextColumn::make('updated_at')
                //     ->label('Diubah')
                //     ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('seminar_id')
                    ->label('Pilih Seminar')
                    ->options(Seminar::all()->pluck('judul', 'id'))
                    ->searchable(),
            ])
            ->actions([
                // Tidak ada aksi individual
            ])
            ->bulkActions([
                // Tidak ada bulk action
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
