<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Provinsi;
use Filament\Forms\Form;
use App\Models\Kecamatan;
use App\Models\Pengaduan;
use Filament\Tables\Table;
use App\Models\DataPelapor;
use App\Models\JenisPelapor;
use App\Models\KotaKabupaten;
use App\Models\KategoriPelapor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\KelompokInstansi;
use Filament\Resources\Resource;
use App\Models\KlasifikasiInstansi;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard\Step;
use App\Filament\Resources\PengaduanResource\Pages;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?int $navigationSort = -2;

    protected static ?string $navigationLabel = 'Pengaduan';

    protected static ?string $navigationIcon = 'fluentui-chat-bubbles-question-20';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    // Step 1: Data Pelapor
                    Step::make('Data Pelapor')
                    ->icon('fluentui-person-info-16')
                        ->schema([
                        Section::make([
                            TextInput::make('nama_pelapor')
                            ->label('Nama Pelapor')
                            ->required(),
                            TextInput::make('jenis_identitas')
                                ->label('Jenis Identitas')
                                ->required(),
                            TextInput::make('nomor_identitas')
                                ->label('Nomor Identitas')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required(),
                            TextInput::make('nomor_telepon')
                                ->label('Nomor Telepon')
                                ->tel()
                                ->required(),
                            Textarea::make('alamat_lengkap')
                                ->label('Alamat Lengkap')
                                ->required(),
                            TextInput::make('tempat_lahir')
                                ->label('Tempat Lahir')
                                ->required(),
                            DatePicker::make('tanggal_lahir')
                                ->label('Tanggal Lahir')
                                ->required(),
                            Select::make('jenis_kelamin')
                                ->label('Jenis Kelamin')
                                ->options([
                                    'Pria' => 'Pria',
                                    'Wanita' => 'Wanita',
                                ])
                                ->required(),
                            TextInput::make('status_perkawinan')
                                ->label('Status Perkawinan')
                                ->required(),
                            TextInput::make('pekerjaan')
                                ->label('Pekerjaan')
                                ->required(),
                            TextInput::make('pendidikan_terakhir')
                                ->label('Pendidikan Terakhir')
                                ->required(),
                            TextInput::make('warga_negara')
                                ->label('Warga Negara')
                                ->required(),
                            Select::make('id_provinsi')
                                ->label('Provinsi')
                                ->relationship('provinsi', 'nama_provinsi')
                                ->live()
                                ->required()
                                ->placeholder('Pilih Provinsi')
                                ->reactive() // Agar bisa memperbarui data secara dinamis
                                ->afterStateUpdated(function ($set) {
                                    // Reset kota dan kecamatan ketika provinsi diubah
                                    $set('id_kota_kabupaten', null);
                                    $set('id_kecamatan', null);
                                }),
                            
                            Select::make('id_kota_kabupaten')
                                ->label('Kabupaten/Kota')
                                ->relationship('kabupaten', 'nama_kota_kabupaten')
                                ->required()
                                ->placeholder('Pilih Kota / Kabupaten')
                                ->reactive() // Agar pilihan kota kabupaten dinamis mengikuti provinsi
                                ->options(function (callable $get) {
                                    $provinsiId = $get('id_provinsi');
                                    if (!$provinsiId) {
                                        return [];
                                    }
                                    return \App\Models\KotaKabupaten::where('id_provinsi', $provinsiId)
                                        ->pluck('nama_kota_kabupaten', 'id');
                                })
                                ->afterStateUpdated(function ($set) {
                                    // Reset kecamatan ketika kota/kabupaten diubah
                                    $set('id_kecamatan', null);
                                }),
                            
                            Select::make('id_kecamatan')
                                ->label('Kecamatan')
                                ->relationship('kecamatan', 'nama_kecamatan')
                                ->required()
                                ->placeholder('Pilih Kecamatan')
                                ->reactive() // Agar pilihan kecamatan dinamis mengikuti kota kabupaten
                                ->options(function (callable $get) {
                                    $kabupatenId = $get('id_kota_kabupaten');
                                    if (!$kabupatenId) {
                                        return [];
                                    }
                                    return \App\Models\Kecamatan::where('id_kota_kabupaten', $kabupatenId)
                                        ->pluck('nama_kecamatan', 'id');
                                }),
                            
                            Select::make('rahasia_data')
                                ->label('Rahasia Data')
                                ->options([
                                    'Ya' => 'Ya',
                                    'Tidak' => 'Tidak',
                                ])
                                ->required(),
                            ]) 
                            ->relationship('pelapor'),
                        ]),
                        

                    // Step 2: Data Pengaduan
                    Step::make('Data Pengaduan')
                        ->icon('mdi-folder-information')
                        ->schema([
                            Section::make([
                                Select::make('id_kategori_pelapor')
                                ->label('Kategori Pelapor')
                                ->relationship('KategoriPelapor')
                                ->options(
                                    KategoriPelapor::all()->pluck('nama_kategori', 'id')->toArray()
                                )
                                ->required(),
                            Select::make('id_jenis_pelapor')
                                ->label('Jenis Pelapor')
                                ->options(
                                    JenisPelapor::all()->pluck('nama_jenis', 'id')->toArray()
                                )
                                ->required(),
                            Textarea::make('perihal')
                                ->label('Perihal Pengaduan')
                                ->nullable()
                                ->placeholder('Tuliskan perihal pengaduan'),
                            DatePicker::make('tanggal_upaya')
                                ->label('Tanggal Upaya')
                                ->nullable()
                                ->placeholder('Pilih tanggal upaya'),
                            FileUpload::make('file_bukti')
                                ->label('File Bukti Pengaduan')
                                ->disk('public')
                                ->directory('bukti_pengaduan')
                                ->nullable()
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                ->placeholder('Upload file bukti pengaduan'),
                            PdfViewerField::make('file_bukti')
                                ->label(' File Bukti')
                                ->minHeight('40svh'),
                            FileUpload::make('file_identitas')
                                ->label('File Identitas')
                                ->required()
                                ->disk('public')
                                ->directory('file_identitas')
                                ->nullable()
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                ->placeholder('Upload file identitas pelapor'),
                            PdfViewerField::make('file_identitas')
                                ->label(' File Identitas')
                                ->minHeight('40svh'),
                            FileUpload::make('file_uraian')
                                ->label('File Uraian Pengaduan')
                                ->disk('public')
                                ->directory('file_uraian')
                                ->nullable()
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                ->placeholder('Upload file uraian pengaduan'),
                            PdfViewerField::make('file_uraian')
                                ->label(' File Uraian')
                                ->minHeight('40svh'),
                            Select::make('bukti_upaya')
                                ->label('Bukti Upaya')
                                ->options([
                                    'Ada' => 'Ada',
                                    'Tidak Ada' => 'Tidak Ada',
                                ])
                                ->nullable()
                                ->placeholder('Pilih status bukti upaya'),
                            Textarea::make('harapan_pelapor')
                                ->label('Harapan Pelapor')
                                ->nullable()
                                ->placeholder('Tuliskan harapan pelapor terkait pengaduan ini'),
                                ])
                        ]),

                    // Step 3: Data Terlapor
                    Step::make('Data Terlapor')
                        ->icon('grommet-contact-info')
                        ->schema([
                        Section::make([
                            TextInput::make('nama_terlapor')
                                ->label('Nama Terlapor')
                                ->maxLength(100)
                                ->placeholder('Nama Terlapor'),
                            TextInput::make('jabatan_terlapor')
                                ->label('Jabatan Terlapor')
                                ->maxLength(100)
                                ->placeholder('Jabatan Terlapor'),
                            // Select::make('id_kelompok_instansi')
                            //     ->label('Kelompok Instansi')
                            //     ->relationship('KelompokInstansi', 'nama_kelompok_instansi')
                            //     ->required()
                            //     ->placeholder('Pilih Kelompok Instansi'),
                            // Select::make('id_klasifikasi_instansi')
                            //     ->label('Klasifikasi Instansi')
                            //     ->relationship('KlasifikasiInstansi', 'nama_klasifikasi_instansi')
                            //     ->required()
                            //     ->placeholder('Pilih Klasifikasi Instansi'),
                            TextInput::make('instansi_terlapor')
                                ->label('Instansi Terlapor')
                                ->required()
                                ->maxLength(100)
                                ->placeholder('Instansi Terlapor'),
                            Textarea::make('alamat_lengkap')
                                ->label('Alamat Lengkap')
                                ->required()
                                ->maxLength(250)
                                ->placeholder('Alamat Lengkap'),
                                Select::make('id_provinsi')
                                ->label('Provinsi')
                                ->relationship('provinsi', 'nama_provinsi')
                                ->live()
                                ->required()
                                ->placeholder('Pilih Provinsi')
                                ->reactive() // Agar bisa memperbarui data secara dinamis
                                ->afterStateUpdated(function ($set) {
                                    // Reset kota dan kecamatan ketika provinsi diubah
                                    $set('id_kota_kabupaten', null);
                                    $set('id_kecamatan', null);
                                }),
                            
                            Select::make('id_kota_kabupaten')
                                ->label('Kabupaten/Kota')
                                ->relationship('kabupaten', 'nama_kota_kabupaten')
                                ->required()
                                ->placeholder('Pilih Kota / Kabupaten')
                                ->reactive() // Agar pilihan kota kabupaten dinamis mengikuti provinsi
                                ->options(function (callable $get) {
                                    $provinsiId = $get('id_provinsi');
                                    if (!$provinsiId) {
                                        return [];
                                    }
                                    return \App\Models\KotaKabupaten::where('id_provinsi', $provinsiId)
                                        ->pluck('nama_kota_kabupaten', 'id');
                                })
                                ->afterStateUpdated(function ($set) {
                                    // Reset kecamatan ketika kota/kabupaten diubah
                                    $set('id_kecamatan', null);
                                }),
                            
                            Select::make('id_kecamatan')
                                ->label('Kecamatan')
                                ->relationship('kecamatan', 'nama_kecamatan')
                                ->required()
                                ->placeholder('Pilih Kecamatan')
                                ->reactive() // Agar pilihan kecamatan dinamis mengikuti kota kabupaten
                                ->options(function (callable $get) {
                                    $kabupatenId = $get('id_kota_kabupaten');
                                    if (!$kabupatenId) {
                                        return [];
                                    }
                                    return \App\Models\Kecamatan::where('id_kota_kabupaten', $kabupatenId)
                                        ->pluck('nama_kecamatan', 'id');
                                }),
                                ]) 
                                ->relationship('terlapor'),
                        ]),
                        // Step 4: Kronologi
                            Step::make('Kronologi')
                                ->icon('mdi-clock-time-four-outline')
                                ->schema([
                                    Section::make([
                                        Repeater::make('kronologi')
                                            ->label('Kronologi Kejadian')
                                            ->relationship('kronologi')
                                            ->schema([
                                                Textarea::make('deskripsi_kronologi')
                                                    ->label('Deskripsi Kronologi')
                                                    ->placeholder('Tuliskan kronologi kejadian')
                                                    ->required(),
                                                    DatePicker::make('tanggal_kronologi')
                                                    ->label('Tanggal Kejadian')
                                                    ->required(),
                                                    Textarea::make('catatan_bukti')
                                                        ->label('Catatan Bukti')
                                                        ->placeholder('Keterangan Bukti')
                                                        ->required(),
                                            ])
                                            ->maxItems(10) // Maksimum 10 item
                                    ])
                                    
                                ]),

                ]) 
                ->skippable()
                ->columnspanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pelapor.nama_pelapor')
                    ->label('Nama Pelapor')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenisPelapor.nama_jenis')
                    ->label('Jenis Pelapor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->label('Perihal')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->sortable()
                    ->date(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('pdf')
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-s-arrow-down-tray')
                ->action(function (Pengaduan $record) {
                    
                    $pdf = Pdf::loadView('pdf.form', ['record' => $record])
                ->setPaper('A4', 'portrait') // Pilih ukuran kertas
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => true
                ]);
                    return response()->streamDownload(
                        fn () => print($pdf->output()), 
                        'Formulir-' . $record->pelapor->nama_pelapor . '.pdf', 
                        ['Content-Type' => 'application/pdf']
                    );
                    
})
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.pengaduan");
    }
}