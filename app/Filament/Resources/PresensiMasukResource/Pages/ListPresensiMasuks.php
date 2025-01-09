<?php

namespace App\Filament\Resources\PresensiMasukResource\Pages;

use App\Filament\Resources\PresensiMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPresensiMasuks extends ListRecords
{
    protected static string $resource = PresensiMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
