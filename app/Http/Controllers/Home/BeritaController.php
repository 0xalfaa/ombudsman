<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pencarian
        $data = $request->only(["search"]);
        
        // Mengambil data berita dengan filter, sorting dan paginasi
        $berita = Berita::filter($data) // Apply filter if any
            ->orderBy("judul", "asc") // Sorting berdasarkan judul berita
            ->paginate(3) // Paginasi 3 berita per halaman
            ->withQueryString(); // Menjaga query string tetap ada saat halaman dipindah
        
        // Mengembalikan view dengan data berita
        return view('pages.landing-page.berita.index', compact('berita'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id); // Mencari berita berdasarkan ID, atau 404 jika tidak ditemukan
        return view('pages.landing-page.berita.show', compact('berita'));
    }
}
