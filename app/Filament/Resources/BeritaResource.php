<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Berita;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\BeritaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BeritaResource\RelationManagers;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?int $navigationSort = -1;

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $navigationIcon = 'typ-news';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(255),
            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->required(),
            TextInput::make('penulis')
                ->label('Penulis')
                ->maxLength(100)
                ->nullable(),
            FileUpload::make('gambar')
                ->label('Gambar')
                ->image()
                ->nullable(),
            DateTimePicker::make('tanggal')
                ->label('Tanggal')
                ->nullable(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('kategori')
                //     ->sortable(),
                TextColumn::make('deskripsi'),
                TextColumn::make('penulis'),
                ImageColumn::make('gambar')
                    ->size(70),
                TextColumn::make('tanggal')
                    ->dateTime(),
                TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime(),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.berita");
    }
}
