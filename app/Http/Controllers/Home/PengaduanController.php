<?php

namespace App\Http\Controllers\Home;

use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Pengaduan;
use App\Models\DataPelapor;
use App\Models\JenisPelapor;
use App\Models\KotaKabupaten;
use App\Models\KategoriPelapor;
use App\Models\DataTerlapor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{

    public function create()
    {
        // Ambil data kategori pelapor, jenis pelapor, provinsi, kota, kecamatan untuk form
        $kategori_pelapor = KategoriPelapor::all();
        $jenis_pelapor = JenisPelapor::all();
        $provinsi = Provinsi::all();
        $kota_kabupaten = KotaKabupaten::all();
        $kecamatan = Kecamatan::all();

        return view('pages.landing-page.lapor.index', compact('kategori_pelapor', 'jenis_pelapor', 'provinsi', 'kota_kabupaten', 'kecamatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sudah_lapor' => 'required|in:Ya,Belum',
            'kategori_pelapor' => 'required|exists:kategori_pelapor,id',
            'jenis_pelapor' => 'required|exists:jenis_pelapor,id',
            'tanggal_upaya' => 'required|date',
            'file_bukti' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'file_identitas' => 'required|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'file_uraian' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'bukti_upaya' => 'required|string',
            'perihal' => 'required|string',
            'harapan_pelapor' => 'required|string',
            'nama_pelapor' => 'required|string',
            'warga_negara' => 'required|string',
            'jenis_identitas' => 'required|string',
            'nomor_identitas' => 'required|digits:16',
            ], [
                'nomor_identitas.required' => 'Nomor identitas wajib diisi.',
                'nomor_identitas.digits' => 'Nomor identitas harus berisi tepat 16 angka.',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'status_perkawinan' => 'required|string',
            'pekerjaan' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|exists:provinsi,id',
            'kota_kabupaten' => 'required|exists:kota_kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
            'nomor_telepon' => 'required|string',
            'email' => 'required|email',
            'rahasia_data' => 'required|string',
            'nama_terlapor' => 'required|string',
            'jabatan_terlapor' => 'required|string',
            'instansi_terlapor' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|exists:provinsi,id',
            'kota_kabupaten' => 'required|exists:kota_kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
        ]);

        // Simpan data pelapor terlebih dahulu
        $dataPelapor = DataPelapor::create([
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
            'id_provinsi' => $request->provinsi,
            'id_kota_kabupaten' => $request->kota_kabupaten,
            'id_kecamatan' => $request->kecamatan,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'rahasia_data' => $request->rahasia_data,
        ]);

        // Upload file dan simpan path-nya
        $file_bukti = $request->file('file_bukti') ? $request->file('file_bukti')->store('bukti') : null;
        $file_identitas = $request->file('file_identitas')->store('identitas');
        $file_uraian = $request->file('file_uraian') ? $request->file('file_uraian')->store('uraian') : null;

        $dataTerlapor = DataTerlapor::create([
            'id_provinsi' => $request->provinsi,
            'id_kota_kabupaten' => $request->kota_kabupaten,
            'id_kecamatan' => $request->kecamatan,
            'id_pelapor' => $dataPelapor->id,
            'nama_terlapor' => $request->nama_terlapor,
            'jabatan_terlapor' => $request->jabatan_terlapor,
            'instansi_terlapor' => $request->instansi_terlapor,
            'alamat_lengkap' => $request->alamat_lengkap,

        ]);

        // Simpan data pengaduan
        Pengaduan::create([
            'sudah_lapor' => $request->sudah_lapor,
            'id_pelapor' => $dataPelapor->id,
            'id_terlapor' => $dataTerlapor->id,
            'id_kategori_pelapor' => $request->kategori_pelapor,
            'id_jenis_pelapor' => $request->jenis_pelapor,
            'file_bukti' => $file_bukti,
            'file_identitas' => $file_identitas,
            'file_uraian' => $file_uraian,
            'tanggal_upaya' => $request->tanggal_upaya,
            'bukti_upaya' => $request->bukti_upaya,
            'perihal' => $request->perihal,
            'harapan_pelapor' => $request->harapan_pelapor,
        ]);

        
    

        // Redirect ke halaman setelah berhasil
        return redirect()->route('pengaduan.create')->with('success', 'Pengaduan berhasil dikirim!');
    }


    public function getKotaKabupaten($provinsiId)
    {
        $kotaKabupaten = KotaKabupaten::where('id_provinsi', $provinsiId)->get();
        return response()->json($kotaKabupaten);
    }
    
    // Ambil Kecamatan berdasarkan Kota/Kabupaten
    public function getKecamatan($kotaKabupatenId)
    {
        $kecamatan = Kecamatan::where('id_kota_kabupaten', $kotaKabupatenId)->get();
        return response()->json($kecamatan);
    }

}
