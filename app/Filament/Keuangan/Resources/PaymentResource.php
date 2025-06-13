<?php

namespace App\Filament\Keuangan\Resources;

use App\Filament\Keuangan\Resources\PaymentResource\Pages;
use App\Filament\Keuangan\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jumlah_pembayaran')
                    ->numeric()
                    ->label('Jumlah Pembayaran')
                    ->required(),

                Forms\Components\Select::make('status_pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'cenceled' => 'Canceled', // typo di migration-nya, sebaiknya perbaiki nanti
                        'refunden' => 'Refunded', // typo juga, mestinya 'refunded'
                    ])
                    ->label('Status Pembayaran')
                    ->required(),

                Forms\Components\TextInput::make('invoice_url')
                    ->url()
                    ->label('Invoice URL')
                    ->nullable(),

                Forms\Components\Select::make('pendaftaran_id')
                    ->relationship('pendaftaran', 'id') // asumsikan relasi model sudah dibuat
                    ->label('ID Pendaftaran')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jumlah_pembayaran')
                    ->label('Jumlah Pembayaran')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status_pembayaran')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => fn($state) => in_array($state, ['failed', 'cenceled', 'refunden']),
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('invoice_url')
                    ->label('Invoice URL')
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('pendaftaran_id')
                    ->label('ID Pendaftaran'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
