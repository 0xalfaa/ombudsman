<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Presensi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PresensiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PresensiResource\RelationManagers;

class PresensiResource extends Resource
{
    protected static ?string $model = Presensi::class;

    protected static ?string $navigationLabel = 'Presensi';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(auth()->id())
                ->required(),
                DatePicker::make('tanggal')
                ->label('Tanggal')
                ->default(now()->toDateString()),
                 // Tidak dapat diubah oleh user
                TimePicker::make('waktu_masuk')
                    ->label('Waktu Masuk')
                    ->default(now()->toTimeString())
                    ->disabled(),
                     // Otomatis terisi
                TimePicker::make('waktu_keluar')
                    ->label('Waktu Keluar')
                    // ->default(now()->toTimeString())
                    ->nullable(),
                Select::make('keterangan')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit',
                    ])
                ->required(),
                FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->nullable(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('NamaMagang.full_name')
                ->label('Nama')
                ->sortable()
                ->searchable(),
            TextColumn::make('tanggal')
                ->label('Tanggal')
                ->sortable()
                ->searchable(),
            TextColumn::make('created_at')
                ->label('Waktu Masuk')
                ->dateTime('H:i:s'),
            TextColumn::make('waktu_keluar')
                ->label('Waktu Keluar'),
            TextColumn::make('keterangan')
                ->label('Keterangan'),
            ImageColumn::make('gambar')
                ->size(70),
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


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id(); // Tambahkan user_id berdasarkan user yang login
        return $data;
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id(); // Pastikan user_id selalu sesuai saat data diperbarui
        return $data;
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
            'index' => Pages\ListPresensis::route('/'),
            'create' => Pages\CreatePresensi::route('/create'),
            'edit' => Pages\EditPresensi::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.presensi");
    }


}
