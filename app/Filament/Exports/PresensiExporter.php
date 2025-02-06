<?php

namespace App\Filament\Exports;

use App\Models\Presensi;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PresensiExporter extends Exporter
{
    protected static ?string $model = Presensi::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('NamaMagang.full_name')
                ->label('Nama'),
            ExportColumn::make('tanggal')
                ->label('Tanggal'),
            ExportColumn::make('created_at') 
                ->label('Waktu Masuk'),
            ExportColumn::make('waktu_keluar')
                ->label('Waktu Keluar'),
            ExportColumn::make('keterangan')
                ->label('Keterangan'),
        ];
    }


    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your presensi export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public static function getCsvDelimiter(): string
{
    return ',';
}
}
