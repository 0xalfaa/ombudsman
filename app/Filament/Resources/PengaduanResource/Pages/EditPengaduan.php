<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaduan extends EditRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     // Mengambil data pelapor terkait
    //     $pelapor = $this->record->DataPelapor;

    //     // Jika pelapor ditemukan, tambahkan ke data form
    //     if ($pelapor) {
    //         $data['pelapor'] = [
    //             'nama_pelapor' => $pelapor->nama_pelapor,
    //             'warga_negara' => $pelapor->warga_negara,
    //             'nomor_telepon' => $pelapor->nomor_telepon,
    //             'email' => $pelapor->email,
    //             'alamat_lengkap' => $pelapor->alamat_lengkap,
    //         ];
    //     }

    //     return $data;
    // }
}
