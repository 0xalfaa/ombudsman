<?php

namespace App\Filament\Resources\PresensiMasukResource\Pages;

use App\Filament\Resources\PresensiMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPresensiMasuk extends EditRecord
{
    protected static string $resource = PresensiMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
