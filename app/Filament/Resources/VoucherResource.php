<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\BelongsToSelect;



class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required(),

                TextInput::make('code_voucher')
                    ->label('Kode Voucher')
                    ->unique()
                    ->required(),

                DateTimePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->nullable(),

                DateTimePicker::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->nullable(),

                TextInput::make('penggunaan_voucher')
                    ->label('Penggunaan Voucher')
                    ->numeric()
                    ->required(),

                TextInput::make('maksimal_pemakaian')
                    ->label('Maksimal Pemakaian')
                    ->numeric()
                    ->required(),

                TextInput::make('diskon_harga')
                    ->label('Diskon Harga (Rp)')
                    ->numeric()
                    ->default(0),

                TextInput::make('diskon_persen')
                    ->label('Diskon Persen (%)')
                    ->numeric()
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'expired' => 'Expired',
                        'used' => 'Terpakai',
                    ])
                    ->default('active')
                    
                    ->disabled()
                    ->required(),
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
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
