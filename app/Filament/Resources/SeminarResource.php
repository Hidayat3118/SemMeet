<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Seminar;
use Filament\Forms\Form;
use Tables\Columns\Text;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use function Laravel\Prompts\select;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\SeminarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SeminarResource\RelationManagers;

class SeminarResource extends Resource
{
    protected static ?string $model = Seminar::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('judul')->required(),

                DateTimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required()
                    ->withoutSeconds(),

                DateTimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->required()
                    ->withoutSeconds(),

                TextInput::make('kouta')
                    ->label('Kouta Peserta')
                    ->numeric()->required(),

                TextInput::make('harga')
                    ->label('Biaya')
                    ->numeric()
                    ->inputMode('decimal')
                    ->step(10000)
                    ->rules(['numeric', 'min:0'])
                    ->prefix('Rp')
                    ->required(),

                Select::make('status')
                    ->label('Status Seminar')
                    ->options([
                        'draft' => 'Draft',
                        'aktif' => 'Aktif',
                        'selesai' => 'Selesai',
                    ])
                    ->required()
                    ->default('draft')
                    ->disabled(),

                    Select::make('mode')
                    ->label('Mode Seminar')
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ])
                    ->default('offline')
                    ->required()
                    ->reactive(), 

                    // perubahan
                TextInput::make('metting_link')
                    ->label('Metting Link')
                    ->visible(fn($get) => $get('mode') === 'online') // hanya muncul jika online
                    ->url()
                    ->required(fn($get) => $get('mode') === 'online'),

                TextInput::make('lokasi')
                    ->label('Lokasi Seminar')
                    ->visible(fn($get) => $get('mode') === 'offline') // hanya muncul jika offline
                    ->required(fn($get) => $get('mode') === 'offline'),

                Textarea::make('deskripsi')
                    ->label("Deskripsi Seminar")
                    ->required(),

                Select::make('pembicara_id')
                    ->label('Moderator')
                    ->options(function () {
                        return \App\Models\User::role('moderator')
                            ->with('moderator')
                            ->get()
                            ->filter(fn($user) => $user->moderator)
                            ->mapWithKeys(function ($user) {
                                return [$user->moderator->id => $user->name];
                            });
                    })
                    ->searchable()
                    ->required(),

                Select::make('moderator_id')
                    ->label('Moderator')
                    ->options(function () {
                        return \App\Models\User::role('moderator')
                            ->with('moderator')
                            ->get()
                            ->filter(fn($user) => $user->moderator)
                            ->mapWithKeys(function ($user) {
                                return [$user->moderator->id => $user->name];
                            });
                    })
                    ->searchable()
                    ->required(),


                Select::make('keuangan_id')
                    ->label('Keuangan')
                    ->options(function () {
                        return \App\Models\User::role('keuangan')
                            ->with('keuangan')
                            ->get()
                            ->filter(fn($user) => $user->keuangan)
                            ->mapWithKeys(function ($user) {
                                return [$user->keuangan->id => $user->name];
                            });
                    })
                    ->searchable()
                    ->required(),

                Select::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama')
                    ->required(),

                FileUpload::make('foto')
                    ->image()
                    ->disk('public') // WAJIB
                    ->imagePreviewHeight('100')
                    ->directory('foto-seminar')
                    ->required(false)
                    ->maxSize(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('deskripsi')
                    ->label('deskripsi'),

                TextColumn::make('lokasi')
                    ->label('Lokasi'),

                TextColumn::make('metting_link')
                    ->label('Metting Link'),

                TextColumn::make('mode')
                    ->label('Mode'),

                TextColumn::make('status')
                    ->label('Status'),

                TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->dateTime('Y-m-d H:i:s'),

                TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->dateTime('Y-m-d H:i:s'),

                TextColumn::make('kouta')
                    ->label('Kuota'),

                TextColumn::make('harga')
                    ->label('Biaya'),

                ImageColumn::make('foto')
                    ->disk('public')
                    ->label('Foto'),

                    
                    // ->circular(), // opsional agar tampil bulat


                // Tables\Columns\Badge::make('status')
                //     ->label('Status')
                //     ->enum([
                //         'draft' => 'Draft',
                //         'aktif' => 'Aktif',
                //         'selesai' => 'Selesai',
                //     ])
                //     ->colors([
                //         'draft' => 'gray',
                //         'aktif' => 'green',
                //         'selesai' => 'blue',
                //     ]),

                // Menampilkan pembicara
                // TextColumn::make('pembicara_count')
                //     ->label('Jumlah Pembicara')
                //     ->getStateUsing(fn(Seminar $record) => $record->pembicaras()->count()),
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
            'index' => Pages\ListSeminars::route('/'),
            'create' => Pages\CreateSeminar::route('/create'),
            'edit' => Pages\EditSeminar::route('/{record}/edit'),
        ];
    }
}
