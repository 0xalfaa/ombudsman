<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Saran;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SaranResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SaranResource\RelationManagers;
use Filament\Actions\CreateAction;

class SaranResource extends Resource
{
    protected static ?string $model = Saran::class;

    protected static ?string $navigationIcon = 'fluentui-mail-arrow-down-20';

    protected static ?string $navigationLabel = 'Saran';

    protected static ?int $navigationSort = -1;

    public static function canCreate(): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                ->label('Tanggal'),
                TextColumn::make('isi')
                ->label('Keterangan'),
                ImageColumn::make('file')
                ->size(70),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->hidden(fn($record) => !$record->is_editable),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListSarans::route('/'),
            'create' => Pages\CreateSaran::route('/create'),
            // 'edit' => Pages\EditSaran::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    { 
        return __("menu.nav_group.saran");
    }
}
