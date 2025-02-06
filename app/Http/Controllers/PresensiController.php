<?php
namespace App\Http\Controllers;
use App\Models\Presensi;


use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PresensiController extends Controller
{
   // PresensiController.php
// PresensiController.php
public function printPresensi($userId) // <-- Parameter sebagai ID (string/number)
{
    $user = User::with(['presensi' => function($query) {
        $query->orderBy('tanggal');
    }])->findOrFail($userId); // Cari user berdasarkan ID

    // Generate PDF
    $pdf = PDF::loadView('presensi.pdf', [
        'user' => $user,
        'presensi' => $user->presensi
    ])->setPaper('a4', 'landscape');

    return $pdf->download("presensi-{$user->name}.pdf");
}
}