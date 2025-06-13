<?php

namespace App\Filament\Keuangan\Resources;

use App\Filament\Keuangan\Resources\PendaftaranResource\Pages;
use App\Filament\Keuangan\Resources\PendaftaranResource\RelationManagers;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jumlah')
                    ->numeric()
                    ->label('Jumlah')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status Pendaftaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'attended' => 'Attended',
                    ])
                    ->required(),

                Forms\Components\Select::make('voucher_id')
                    ->label('Voucher')
                    ->relationship('voucher', 'id') // ganti 'id' jika ada nama lain seperti 'kode'
                    ->searchable()
                    ->nullable(),

                Forms\Components\Select::make('seminar_id')
                    ->label('Seminar')
                    ->relationship('seminar', 'judul') // ganti 'judul' sesuai nama kolom yang informatif
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('peserta_id')
                    ->label('Peserta')
                    ->relationship('peserta', 'nama') // ganti 'nama' sesuai dengan kolom informatif peserta
                    ->searchable()
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'info' => 'attended',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('voucher.kode') // jika field di voucher ada 'kode'
                    ->label('Voucher')
                    ->searchable(),

                Tables\Columns\TextColumn::make('seminar.judul') // ganti 'judul' sesuai nama kolom seminar
                    ->label('Seminar')
                    ->searchable(),

                Tables\Columns\TextColumn::make('peserta.nama') // ganti 'nama' sesuai kolom peserta
                    ->label('Peserta')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
