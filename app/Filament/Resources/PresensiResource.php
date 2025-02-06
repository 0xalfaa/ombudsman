<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Presensi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\PresensiExporter;
use Filament\Tables\Actions\ExportBulkAction;
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
                ->default(now()->toDateString())
                ->readOnly(),
                 // Tidak dapat diubah oleh user
                TimePicker::make('waktu_masuk')
                    ->label('Waktu Masuk')
                    ->default(now()->toTimeString())
                    ->readOnly(),
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
                SelectFilter::make('user_id')
                ->label('Filter Nama')
                ->relationship('NamaMagang', 'username'),
                SelectFilter::make('created_at')
            ->form([
                Select::make('bulan')
                    ->label('Filter Berdasarkan Bulan')
                    ->options([
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ])
                    ->placeholder('Pilih Bulan'),
            ])
            ->query(function (Builder $query, array $data): Builder {
                if (isset($data['bulan'])) {
                    return $query->whereMonth('created_at', $data['bulan']);
                }

                return $query;
            }),
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions ([
                ExportAction::make()
                ->exporter(PresensiExporter::Class)
                ->label('Export Presensi'),
                Action::make('export_pdf')
                ->label('Export Presensi Anda')
                ->color('success')
                ->icon('heroicon-s-arrow-down-tray')
                ->action(function () {
                    $user = Auth::user(); // Ambil user yang sedang login

                    if (!$user) {
                        throw new \Exception("User tidak ditemukan atau belum login.");
                    }

                    $presensi = $user->presensi; // Ambil data presensi dari user login

                    if ($presensi->isEmpty()) {
                        throw new \Exception("Tidak ada data presensi yang tersedia.");
                    }

                    $pdf = Pdf::loadView('pdf.presensi', compact('user', 'presensi'))
                        ->setPaper('A4', 'portrait');

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        'Presensi-' . $user->nama . '.pdf',
                        ['Content-Type' => 'application/pdf']
                    );
                })

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                ->exporter(PresensiExporter::Class)
                ->label('Export Presensi'),
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
