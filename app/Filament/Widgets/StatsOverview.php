<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Saran;
use App\Models\Berita;
use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    
    protected function getStats(): array
    {
       $startDate = ! is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();
            
        $beritaCount = $startDate && $endDate
            ? Berita::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->count()
            : Berita::count();
            
        $pengaduanCount = $startDate && $endDate
            ? Pengaduan::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->count()
            : Pengaduan::count();
        
        $saranCount = $startDate && $endDate
            ? Saran::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->count()
            : Saran::count();

        return [
            Stat::make('Berita', $beritaCount),
            Stat::make('Jumlah Pengaduan', $pengaduanCount),
            Stat::make('Saran', $saranCount),
        ];
    }
}
