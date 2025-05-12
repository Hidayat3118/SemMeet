<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Voucher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use PhpParser\Node\Stmt\Label;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\VoucherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Filament\Resources\VoucherResource\RelationManagers;


class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                TextInput::make('code_voucher')
                    ->label('Kode Voucher')
                    ->unique()
                    ->required(),

                TextInput::make('maksimal_pemakaian')
                    ->label('Maksimal Pemakaian')
                    ->numeric()
                    ->required(),

                DateTimePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->nullable(),

                DateTimePicker::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->nullable(),


                TextInput::make('penggunan_voucher')
                    ->label('Penggunan Voucher')
                    ->numeric()
                    ->nullable()
                    ->disabled(),

                TextInput::make('diskon_harga')
                    ->label('Diskon Biaya (Rp)')
                    ->numeric()
                    ->default(0),

                // TextInput::make('diskon_persen')
                //     ->label('Diskon Persen (%)')
                //     ->numeric()
                //     ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'used' => 'Terpakai',
                    ])
                    ->default('active')
                    ->disabled()
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Voucher')
                    ->required(),

                Select::make('seminar_id')
                    ->label('Seminar')
                    ->relationship('seminar', 'judul')
                    ->required(),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('seminar.judul')
                    ->label('Judul Seminar')
                    ->searchable(),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi'),

                TextColumn::make('code_voucher')
                    ->label('Kode Voucher')
                    ->copyable(),

                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->dateTime('Y-m-d H:i:s'),

                TextColumn::make('tanggal_berakhir')
                    ->label('Tanggal Berakhir')
                    ->dateTime('Y-m-d H:i:s'),

                TextColumn::make('maksimal_pemakaian')
                    ->label('Maksimal Pemakaian'),

                TextColumn::make('penggunan_voucher')
                    ->label('Penggunaan Voucher'),

                TextColumn::make('diskon_harga')
                    ->label('Diskon Harga'),
               

                // TextColumn::make('diskon_persen')
                //     ->label('Diskon Persen')
                //     ->suffix('%'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'used',
                        'danger' => 'expired',
                    ]),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
