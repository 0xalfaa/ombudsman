<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Pengaduan;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class BlogPostsChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected static ?string $heading = 'Pengaduan';

    protected function getData(): array
    {
        // Ambil filter tanggal yang diterapkan
        $startDate = isset($this->filters['startDate']) ?
            Carbon::parse($this->filters['startDate'])->startOfDay() :
            Carbon::now()->startOfMonth();  // Default ke awal bulan jika tidak ada filter

        $endDate = isset($this->filters['endDate']) ?
            Carbon::parse($this->filters['endDate'])->endOfDay() :
            Carbon::now()->endOfMonth();

        // Mengambil data tren pengaduan berdasarkan bulan dalam rentang tanggal
        $data = Trend::model(Pengaduan::class)
            ->between($startDate, $endDate)  // Rentang waktu berdasarkan filter
            ->perMonth()                     // Grouping data per bulan
            ->count();                       // Menghitung jumlah pengaduan per bulan

        // Menyiapkan data untuk chart
        return [
            'datasets' => [
                [
                    'label' => 'Pengaduan',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),  // Jumlah pengaduan per bulan
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M Y')),  // Label bulan dan tahun
        ];
    }

    protected function getType(): string
    {
        return 'bar';  // Tipe chart bar
    }
}