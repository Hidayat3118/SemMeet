<?php

namespace App\Filament\Resources;

use App\Models\Karcis;
use App\Models\Seminar;
use Filament\Forms\Form;
use App\Models\Sertifikat;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
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
                TextColumn::make('pendaftaran.peserta.user.name')->label('Nama Peserta'),
                TextColumn::make('pendaftaran.seminar.judul')->label('Seminar')->searchable(),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('waktu_sqan')->label('Waktu Kehadiran')->dateTime(),
                ImageColumn::make('pendaftaran.foto_validasi')
                    ->label('Bukti Pembayaran')
                    ->disk('public') // karena disimpan di storage/app/public
                    ->visibility('visible')
                    ->width(80) // opsional
                    ->height(80)
                    ->url(fn($record) => asset('storage/' . $record->pendaftaran->foto_validasi)) // gambar dibuka di tab baru
                    ->openUrlInNewTab(), // biar klik-nya di tab // opsional
            ])

            ->filters([
                SelectFilter::make('pendaftaran.seminar')
                    ->relationship('pendaftaran.seminar', 'judul')
                    ->label('Pilih Seminar')
                    ->searchable()
                    ->options(Seminar::all()->pluck('judul', 'id')),
            ])
            ->actions([
                // Tidak ada edit action karena dinonaktifkan
                Action::make('Hadirkan Manual')
                    ->label('Hadirkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn(Karcis $record) => $record->status !== 'used') // hanya muncul jika belum hadir
                    ->requiresConfirmation()
                    ->action(function (Karcis $record) {
                        // Update kehadiran
                        $record->update([
                            'status' => 'used',
                            'waktu_sqan' => now(),
                        ]);

                        // Buat sertifikat jika belum ada
                        if (!$record->pendaftaran->sertifikat) {
                            Sertifikat::create([
                                'pendaftaran_id' => $record->pendaftaran_id,
                            ]);
                        }

                        Notification::make()
                            ->title('Peserta berhasil ditandai hadir.')
                            ->success()
                            ->send();
                    }),
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
