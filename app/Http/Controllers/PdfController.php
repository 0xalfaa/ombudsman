<?php
namespace App\Http\Controllers;
use App\Models\Pengaduan;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PdfController extends Controller
{
    public function __invoke(Pengaduan $pengaduan)
    {
        return Pdf::loadView('pdf', ['record' => $pengaduan])
            ->download($pengaduan->id_pengaduan. '.pdf');
    }
}