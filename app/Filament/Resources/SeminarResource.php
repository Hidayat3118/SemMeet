<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SeminarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SeminarResource\RelationManagers;

use function Laravel\Prompts\select;

class SeminarResource extends Resource
{
    protected static ?string $model = Seminar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                DatePicker::make('tanggal')->required(),
                TimePicker::make('waktu_mulai')->required(),
                TimePicker::make('waktu_selesai')->required(),
                TextInput::make('kuota')
                    ->label('Kuota')
                    ->numeric()->required(),
                Select::make('status')
                    ->label('Status Seminar')
                    ->options([
                        'draft' => 'Draft',
                        'aktif' => 'aktif',
                        'selesai' => 'Selesai',
                    ])->required()->default('draft')->disabled(),
                Textarea::make('description')->required(),
                Textarea::make('lokasi')
                    ->label('Lokasi')
                    ->rows(2)
                    ->required(),

                Select::make('mode')
                    ->label('Mode Seminar')
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ]),

                Select::make('moderator_id')
                    ->label('Moderator')
                    ->relationship(
                        'moderator',  // Nama relasi di model User
                        'user.name',  // Mengambil nama dari user yang terkait
                        modifyQueryUsing: fn($query) => $query->whereHas('user.roles', fn($q) => $q->where('name', 'moderator'))
                    )
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->user->name ?? '-')
                    // ->searchable()
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
            'index' => Pages\ListSeminars::route('/'),
            'create' => Pages\CreateSeminar::route('/create'),
            'edit' => Pages\EditSeminar::route('/{record}/edit'),
        ];
    }
}
