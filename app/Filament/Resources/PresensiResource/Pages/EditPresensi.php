<?php

namespace App\Filament\Resources\PresensiResource\Pages;

use App\Filament\Resources\PresensiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPresensi extends EditRecord
{
    protected static string $resource = PresensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
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
}
