@extends('pages.landing-page.layouts.main')

@section('title', 'Lapor')

@section('additional_links')
@endsection

@section('content')
<section class="container px-4">
    <div class="page-heading">
        <div class="page-title">
            <div class="row justify-content-center">
                <div class="col-12 mb-3 header-about mt-3">
                    <h2>Lapor Pengaduan</h2>
                    <hr>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        <div class="col-12 px-5">
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Formulir Pengaduan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Section 1 -->
                        <div id="section1">
                        <!-- Pertanyaan Awal -->
                        <div class="form-group mt-4">
                            <label class="card-title">Apakah anda sudah melaporkan keluhan anda kepada instansi terlapor?</label>
                            <div class="mt-2">
                                <input type="radio" name="sudah_lapor" value="Ya" id="sudahLaporYa" required> Ya, sudah
                                <input type="radio" name="sudah_lapor" value="Belum" id="sudahLaporBelum"> Belum
                            </div>
                        </div>

                        <!-- Alert jika memilih Belum -->
                        <div class="alert alert-danger mt-3 d-none" id="alertBelum">
                            Saudara disarankan untuk menyampaikan pengaduan atau keberatan terlebih dahulu kepada instansi yang dilaporkan (Instansi Terlapor), sesuai ketentuan Pasal 24 Ayat (1) Huruf C Undang-Undang Nomor 37 Tahun 2008 Tentang Ombudsman Republik Indonesia.
                        </div>

                        <!-- Kategori Pelapor -->
                        <div class="form-group mt-4">
                            <label class="card-title">Kategori Pelapor *</label>
                            <select class="form-control select2" name="kategori_pelapor" id="kategoriPelapor" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori_pelapor as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3" id="jenisPelaporContainer">
                            <label>Jenis Pelapor *</label>
                            <select class="form-control select2" name="jenis_pelapor" id="jenisPelapor" required>
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis_pelapor as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Form Data Pengaduan -->
                        <div class="form-group mt-4" id="formPengaduan">
                            <!-- Tanggal Upaya -->
                            <label for="tanggal_upaya">Tanggal Upaya *</label>
                            <input type="date" id="tanggal_upaya" name="tanggal_upaya" class="form-control mt-2">

                            <!-- File Bukti Pengaduan -->
                            <label for="file_bukti" class="mt-3">File Bukti Pengaduan *</label>
                            <input type="file" id="file_bukti" name="file_bukti" class="form-control mt-2" accept=".pdf,.jpg,.jpeg,.png">

                            <!-- File Identitas -->
                            <label for="file_identitas" class="mt-3">File Identitas *</label>
                            <input type="file" id="file_identitas" name="file_identitas" class="form-control mt-2" accept=".pdf,.jpg,.jpeg,.png" required>

                            <!-- File Uraian Pengaduan -->
                            <label for="file_uraian" class="mt-3">File Uraian Pengaduan *</label>
                            <input type="file" id="file_uraian" name="file_uraian" class="form-control mt-2" accept=".pdf,.jpg,.jpeg,.png">

                            <!-- Bukti Upaya -->
                            <label class="mt-3">Bukti Upaya yang Telah Dilakukan dalam Kurun Waktu 2 (Dua) Tahun Terakhir *</label>
                            <div class="mt-2">
                                <input type="radio" id="bukti_upaya_ada" name="bukti_upaya" value="Ada">
                                <label for="bukti_upaya_ada">Ada</label>
                                <input type="radio" id="bukti_upaya_tidak_ada" name="bukti_upaya" value="Tidak Ada">
                                <label for="bukti_upaya_tidak_ada">Tidak Ada</label>
                            </div>

                            <!-- Perihal Pengaduan -->
                            <label for="perihal" class="mt-3">Perihal Pengaduan *</label>
                            <textarea id="perihal" name="perihal" class="form-control mt-2" placeholder="Tuliskan perihal pengaduan"></textarea>

                            <!-- Harapan Pelapor -->
                            <label for="harapan_pelapor" class="mt-3">Harapan Pelapor *</label>
                            <textarea id="harapan_pelapor" name="harapan_pelapor" class="form-control mt-2" placeholder="Tuliskan harapan pelapor terkait pengaduan ini"></textarea>
                        </div>

                        <!-- Tombol Selanjutnya -->
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" onclick="goToNextPage(2)">Selanjutnya</button>
                        </div>

                                </div>
                        <!-- Section 2 -->
                                    <div id="section2" class="d-none">
                                        <h4 class="mt-5 mb-4 text-center">Data Pelapor</h4>
                                        <div class="form-group">
                                            <label>Nama Pelapor</label>
                                            <input type="text" class="form-control" name="nama_pelapor" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Warga Negara</label>
                                            <div>
                                                <input type="radio" name="warga_negara" value="WNI" required> WNI
                                                <input type="radio" name="warga_negara" value="WNA"> WNA
                                                <input type="radio" name="warga_negara" value="Instansi Pemerintah"> Instansi Pemerintah
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Identitas</label>
                                            <select class="form-control" name="jenis_identitas" required>
                                                <option value="KTP">KTP</option>
                                                <option value="SIM">SIM</option>
                                                <option value="Paspor">Paspor</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Identitas</label>
                                            <input type="number" class="form-control" id="nomorIdentitas" name="nomor_identitas" 
                                            required pattern="\d{16}" 
                                            title="Nomor identitas harus berisi 16 angka">
                                            <small id="identitasFeedback" class="text-danger" style="display: none;">
                                                Nomor identitas harus tepat 16 digit.
                                            </small>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir </label>
                                            <input type="text" class="form-control" name="tempat_lahir" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tanggal_lahir" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <div>
                                                <input type="radio" name="jenis_kelamin" value="Wanita" required> Wanita
                                                <input type="radio" name="jenis_kelamin" value="Pria"> Pria
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Perkawinan Pelapor</label>
                                            <select class="form-control" name="status_perkawinan" required>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input type="text" class="form-control" name="pekerjaan" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Pendidikan Terakhir</label>
                                            <select class="form-control" name="pendidikan_terakhir" required>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Magister">Magister</option>
                                                <option value="Doktor">Doktor</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <input type="text" class="form-control" name="alamat_lengkap" required>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="provinsi">Provinsi</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="provinsi" id="provinsi_pelapor" required>
                                                    <option value="">==Pilih Salah Satu==</option>
                                                    @foreach ($provinces as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>                                                                                          
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
                                            <select class="form-control" name="kota" id="kota_pelapor" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                                            <select class="form-control" name="kecamatan" id="kecamatan_pelapor" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text" class="form-control" name="nomor_telepon" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Rahasiakan Data Pelapor</label>
                                            <div>
                                                <input type="radio" name="rahasia_data" value="Ya" required> Ya
                                                <input type="radio" name="rahasia_data" value="Tidak"> Tidak
                                            </div>
                                        </div>
        
                                        <!-- Tombol Submit -->
                                        <div class="form-group text-center mt-4">
                                            <button type="button" class="btn btn-secondary" onclick="goToNextPage(1)">Kembali</button>
                                            <button type="button" class="btn btn-primary" onclick="goToNextPage(3)">Selanjutnya</button>
                                        </div>
                                    </div>
        <!-- Section 3 -->
                                    <div id="section3" class="d-none">
                                        <h4 class="mt-5 mb-4 text-center">Data Terlapor</h4>
                                        
                                        <div class="form-group">
                                            <label>Nama Terlapor</label>
                                            <input type="text" class="form-control" name="nama_terlapor" placeholder="Nama Terlapor" required>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Jabatan Terlapor</label>
                                            <input type="text" class="form-control" name="jabatan_terlapor" placeholder="Jabatan Terlapor" required>
                                        </div>              
                                        <div class="form-group">
                                            <label>Instansi Terlapor *</label>
                                            <input type="text" class="form-control" name="instansi_terlapor" placeholder="Instansi Terlapor" required>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Alamat Lengkap *</label>
                                            <input type="text" class="form-control" name="alamat_lengkap" placeholder="Alamat Lengkap" required>
                                        </div>
                                    
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="provinsi">Provinsi</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="provinsi_terlapor" id="provinsi_terlapor" required>
                                                    <option value="">==Pilih Salah Satu==</option>
                                                    @foreach ($provinces as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>                                                                                             
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
                                            <select class="form-control" name="kota_terlapor" id="kota_terlapor" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mt-4">
                                            <label class="card-title col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                                            <select class="form-control" name="kecamatan_terlapor" id="kecamatan_terlapor" required>
                                                <option value="">==Pilih Salah Satu==</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mt-3">
                                            <div>
                                                <input type="checkbox" name="setuju_syarat" required>
                                                Dengan ini anda menyetujui <a href="#">Syarat Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> pada Pengaduan Online
                                            </div>
                                        </div>
                                        
                                        <!-- Tombol Navigasi -->
                                        <div class="form-group text-center mt-4">
                                            <button type="button" class="btn btn-secondary" onclick="goToNextPage(2)">Kembali</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>                                        
                                    </div>
        
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        
@endsection

@section('additional_scripts')
<script>
    $(document).ready(function () {
        console.log('jQuery Dimuat');

        // Fungsi untuk memuat dropdown dinamis
        function loadDropdown(url, id, targetElement, placeholder) {
            $('#' + targetElement).empty().append('<option value="">Memuat data...</option>');

            $.ajax({
                url: url,
                type: 'GET',
                data: { id: id },
                success: function (data) {
                    $('#' + targetElement).empty().append('<option value="">' + placeholder + '</option>');
                    if (data && Object.keys(data).length > 0) {
                        $.each(data, function (key, value) {
                            $('#' + targetElement).append('<option value="' + key + '">' + value + '</option>');
                        });
                    } else {
                        $('#' + targetElement).append('<option value="">Tidak ada data</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error AJAX:', error);
                }
            });
        }

        // Data Pelapor
        $('#provinsi_pelapor').on('change', function () {
            var provinsiId = $(this).val();
            if (provinsiId) {
                loadDropdown('{{ route("cities") }}', provinsiId, 'kota_pelapor', '==Pilih Kota==');
                $('#kecamatan_pelapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            } else {
                $('#kota_pelapor').empty().append('<option value="">==Pilih Kota==</option>');
                $('#kecamatan_pelapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            }
        });

        $('#kota_pelapor').on('change', function () {
            var kotaId = $(this).val();
            if (kotaId) {
                loadDropdown('{{ route("districts") }}', kotaId, 'kecamatan_pelapor', '==Pilih Kecamatan==');
            } else {
                $('#kecamatan_pelapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            }
        });

        // Data Terlapor
        $('#provinsi_terlapor').on('change', function () {
            var provinsiId = $(this).val();
            if (provinsiId) {
                loadDropdown('{{ route("cities") }}', provinsiId, 'kota_terlapor', '==Pilih Kota==');
                $('#kecamatan_terlapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            } else {
                $('#kota_terlapor').empty().append('<option value="">==Pilih Kota==</option>');
                $('#kecamatan_terlapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            }
        });

        $('#kota_terlapor').on('change', function () {
            var kotaId = $(this).val();
            if (kotaId) {
                loadDropdown('{{ route("districts") }}', kotaId, 'kecamatan_terlapor', '==Pilih Kecamatan==');
            } else {
                $('#kecamatan_terlapor').empty().append('<option value="">==Pilih Kecamatan==</option>');
            }
        });
    });
</script>

<script>
    // Menampilkan alert jika memilih "Belum"
    document.getElementById('sudahLaporBelum').addEventListener('change', function() {
        document.getElementById('alertBelum').classList.remove('d-none');
    });
    document.getElementById('sudahLaporYa').addEventListener('change', function() {
        document.getElementById('alertBelum').classList.add('d-none');
    });


        // Fungsi untuk navigasi antar section
        function goToNextPage(sectionNumber) {
    // Ambil semua section yang ada
    const sections = document.querySelectorAll('[id^="section"]');

    // Loop untuk menyembunyikan semua section
    sections.forEach((section) => {
        section.classList.add('d-none');
    });

    // Tampilkan hanya section yang diminta
    const nextSection = document.querySelector(`#section${sectionNumber}`);
    if (nextSection) {
        nextSection.classList.remove('d-none');
    } else {
        console.error("Section tidak ditemukan. Pastikan ID section sudah benar.");
    }
}
</script>
<script>
    document.getElementById('nomorIdentitas').addEventListener('input', function () {
        const input = this.value;
        const feedback = document.getElementById('identitasFeedback');

        if (input.length === 16 && /^\d+$/.test(input)) {
            feedback.style.display = 'none'; // Sembunyikan pesan jika valid
        } else {
            feedback.style.display = 'block'; // Tampilkan pesan jika tidak valid
        }
    });
</script>
@endsection
