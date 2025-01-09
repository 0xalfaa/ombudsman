<?php

namespace App\Http\Controllers\Home;

use App\Models\Berita;
use App\Models\Pengaduan;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Misalkan Anda ingin mengirim data jumlah pengakuan
        $jumlahPengaduan = Pengaduan::count(); // Gantilah dengan data dinamis jika diperlukan

        $berita = Berita::latest()->get();

        return view('pages.landing-page.home.index', compact('jumlahPengaduan','berita'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kategori_pelapor' => 'required',
            'jenis_pelapor' => 'required',
            'nama_pelapor' => 'required|string|max:100',
            'warga_negara' => 'required|string',
            'jenis_identitas' => 'required|string',
            'nomor_identitas' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'pendidikan_terakhir' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'rahasia_data' => 'required|string',
            'file_identitas' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'file_uraian' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Upload file
        $identitasPath = $request->file('file_identitas')->store('pengaduan/identitas', 'public');
        $buktiPath = $request->file('file_bukti') ? $request->file('file_bukti')->store('pengaduan/bukti', 'public') : null;
        $uraianPath = $request->file('file_uraian') ? $request->file('file_uraian')->store('pengaduan/uraian', 'public') : null;

        // Simpan data pelapor
        $pelapor = DataPelapor::create([
            'kategori_pelapor' => $request->kategori_pelapor,
            'jenis_pelapor' => $request->jenis_pelapor,
            'nama_pelapor' => $request->nama_pelapor,
            'warga_negara' => $request->warga_negara,
            'jenis_identitas' => $request->jenis_identitas,
            'nomor_identitas' => $request->nomor_identitas,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_perkawinan' => $request->status_perkawinan,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'alamat_lengkap' => $request->alamat_lengkap,
            'provinsi' => $request->provinsi,
            'kota_kabupaten' => $request->kota_kabupaten,
            'kecamatan' => $request->kecamatan,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'rahasia_data' => $request->rahasia_data,
        ]);

        // Simpan data pengaduan
        Pengaduan::create([
            'id_pelapor' => $pelapor->id,
            'file_identitas' => $identitasPath,
            'file_bukti' => $buktiPath,
            'file_uraian' => $uraianPath,
            'tanggal_upaya' => $request->tanggal_upaya,
            'bukti_upaya' => $request->bukti_upaya,
            'perihal' => $request->perihal,
            'harapan_pelapor' => $request->harapan_pelapor,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengaduan berhasil disimpan!');
    }
}
