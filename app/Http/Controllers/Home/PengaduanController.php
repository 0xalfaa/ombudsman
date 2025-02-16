<?php

namespace App\Http\Controllers\Home;

use Indonesia;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Pengaduan;
use App\Models\DataPelapor;
use App\Models\DataTerlapor;
use App\Models\JenisPelapor;
use Illuminate\Http\Request;
use App\Models\KotaKabupaten;
use App\Models\KategoriPelapor;
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
        $provinces = Indonesia::allProvinces();
        $cities = Indonesia::allCities();
        $districts = Indonesia::alldistricts();

        return view('pages.landing-page.lapor.index', compact('kategori_pelapor', 'jenis_pelapor', 'provinsi', 'kota_kabupaten', 'kecamatan','provinces','cities','districts'));
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
            'provinsi' => 'required|exists:indonesia_provinces,id',
            'kota' => 'required|exists:indonesia_cities,id',
            'kecamatan' => 'required|exists:indonesia_districts,id',
            'nomor_telepon' => 'required|string',
            'email' => 'required|email',
            'rahasia_data' => 'required|string',
            'nama_terlapor' => 'required|string',
            'jabatan_terlapor' => 'required|string',
            'instansi_terlapor' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'provinsi_terlapor' => 'required|exists:indonesia_provinces,id',
            'kota_terlapor' => 'required|exists:indonesia_cities,id',
            'kecamatan_terlapor' => 'required|exists:indonesia_districts,id',
        ]);

        // Simpan data pelapor terlebih dahulu
        $dataPelapor = DataPelapor::create([
            'provinces_id' => $request->provinsi,
            'city_id' => $request->kota,
            'district_id' => $request->kecamatan,
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
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'rahasia_data' => $request->rahasia_data,
        ]);


        $dataTerlapor = DataTerlapor::create([
            'provinces_id' => $request->provinsi_terlapor,
            'city_id' => $request->kota_terlapor,
            'district_id' => $request->kecamatan_terlapor,
            'id_pelapor' => $dataPelapor->id,
            'nama_terlapor' => $request->nama_terlapor,
            'jabatan_terlapor' => $request->jabatan_terlapor,
            'instansi_terlapor' => $request->instansi_terlapor,
            'alamat_lengkap' => $request->alamat_lengkap,

        ]);

        // Upload file dan simpan path-nya
        try {
            $file_bukti = $request->file('file_bukti') ? $request->file('file_bukti')->store('bukti') : null;
            $file_identitas = $request->file('file_identitas')->store('identitas');
            $file_uraian = $request->file('file_uraian') ? $request->file('file_uraian')->store('uraian') : null;
        
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
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
        
    

        // Redirect ke halaman setelah berhasil
        return redirect()->route('pengaduan.create')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function provinces()
    {
        return \Indonesia::allProvinces();
    }

    public function cities(Request $request)
    {
        return \Indonesia::findProvince($request->id, ['cities'])->cities->pluck('name', 'id'); // Tetap gunakan id untuk mengisi dropdown
    }


    public function districts(Request $request)
    {
        return \Indonesia::findCity($request->id, ['districts'])->districts->pluck('name', 'id'); // Tetap gunakan id untuk mengisi dropdown
    }

    public function villages(Request $request)
    {
        return \Indonesia::findDistrict($request->id, ['villages'])->villages->pluck('name', 'id');
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
