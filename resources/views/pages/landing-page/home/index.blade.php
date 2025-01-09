@extends('pages.landing-page.layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-6 mb-3 header-about bg-home w-100 pb-5">
            <div class="container pt-2 pt-sm-5">
                <div class="row d-flex align-items-center text-sm-start text-center">
                    <div class="col-md-6 col-12" style="z-index: 10">
                        <h1 class="text-white fw-bold">Sistem Layanan Pengaduan Perwakilan Ombudsman RI Provinsi Kalsel</h1>
                        <p class="text-white fs-5 pt-3 pt-sm-4 w-100 ">
                            Sistem Layanan Pengaduan ini dibuat untuk memudahkan dalam menyampaikan aduan terkait pelayanan publik
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('pengaduan.create') }}" class="btn btn-danger text-white block">Buat Pengaduan</a>
                        </div>
                    </div>
                    <div class="col text-center text-md-end mt-5 mt-sm-0">
                        <img src="{{ asset('images/cloud storage.png') }}" alt="illustrasi laptop" class="illust-home"
                            width="70%">
                    </div>
                </div>
                <div class="poligon d-none d-md-block"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="col-12">
                <div class="container">
                    <div class="garis"></div>
                    <div class="row alur-lapor mt-5 d-flex text-center align-content-start">
                        <div class="col">
                            <div class="ellipse"><img src="{{ asset('images/icon/edit-property.svg') }}" alt="icon" width="32"></div>
                            <h5 class="mt-2">Buat Laporan</h5>
                            
                        </div>
                        <div class="col">
                            <div class="ellipse"><img src="{{ asset('images/icon/in-progress.svg') }}" alt="icon" width="36"></div>
                            <h5 class="mt-2">Penerimaan dan Verifikasi</h5>
                            <p class="d-md-block d-none">Langkah pertama untuk memastikan setiap keluhan didengar dengan seksama.</p>
                        </div>
                        <div class="col">
                            <div class="ellipse"><img src="{{ asset('images/icon/Messaging.svg') }}" alt="icon" width="37"></div>
                            <h5 class="mt-2">Pemeriksaan</h5>
                            <p class="d-md-block d-none">Setiap detail diselidiki dengan teliti untuk memastikan keputusan yang adil dan transparan.</p>
                        </div>
                        <div class="col">
                            <div class="ellipse"><img src="{{ asset('images/icon/chat-bubble.svg') }}" alt="icon" width="37"></div>
                            <h5 class="mt-2">Resolusi dan Monitoring</h5>
                            <p class="d-md-block d-none">Setelah menemukan solusi, kami terus memantau untuk memastikan implementasi yang tepat dan kepuasan penuh.</p>
                        </div>
                        <div class="col">
                            <div class="ellipse"><img src="{{ asset('images/icon/Done.svg') }}" alt="icon" width="37"></div>
                            <h5 class="mt-2">Selesai</h5>
                           
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 jumlah-lapor mt-5 text-center">
                        <h3 class="text-white mt-4 fs-6">JUMLAH LAPORAN SEKARANG</h3><br>
                        <p class="text-white fw-bold fs-1 mt-1"> {{ $jumlahPengaduan }} </p><br>
                        
                    </div>
                </div>
                <div class="container">
                    <div class="row my-5">
                        <div class="col-12 mb-5">
                            <h2 class="text-center">Apakah saya akan mendapatkan perlindungan jika melapor ke Ombudsman RI?</h2>
                        </div>
                        <div class="row card-keuntungan d-block d-md-flex justify-content-center text-center mx-auto">
                            <div class="col-12 col-lg-4">
                                <div class="card ms-auto">
                                    <div class="card-body">
                                        <div class="ellipse">
                                            <img src="../images/icon/privasi.svg" alt="icon" width="36"
                                                class="icon-keuntungan">
                                        </div>
                                        <h5 class="my-3">Ombudsman RI Lembaga Bebas dari Campur Tangan Kekuasaan</h5>
                                        <p>
                                            Menurut Pasal 2 UU Nomor 37 Tahun 2008 Ombudsman merupakan lembaga negara yang bersifat mandiri dan tidak memiliki hubungan organik dengan lembaga negara dan instansi pemerintahan lainnya, serta dalam menjalankan tugas dan wewenangnya bebas dari campur tangan kekuasaan lainnya.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card mx-auto">
                                    <div class="card-body">
                                        <div class="ellipse">
                                            <img src="../images/icon/keamanan.svg" alt="icon" width="35"
                                                class="icon-keuntungan">
                                        </div>
                                        <h5 class="my-3">Ombudsman Berasaskan Kerahasiaan</h5>
                                        <p>Menurut Pasal 3 huruf h UU Nomor 37 Tahun 2008 tentang Ombudsman RI, Ombudsman dalam menjalankan tugas dan wewenangnya berasaskan kerahasiaan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card me-auto">
                                    <div class="card-body">
                                        <div class="ellipse">
                                            <img src="../images/icon/identity.svg" alt="icon" width="36"
                                                class="icon-keuntungan">
                                        </div>
                                        <h5 class="my-3">Identitas Pelapor Dirahasiakan</h5>
                                        <p>
                                            Pasal 24 ayat (2) dalam keadaan tertentu, nama dan identitas Pelapor dapat dirahasiakan. Hal tersebut merupakan jaminan kerahasiaan dari Ombudsman untuk melindungi masyarakat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row my-5">
                        <div class="col-12 mb-5">
                            <h2 class="text-center">Berita Terbaru Ombudsman RI Perwakilan Kalsel</h2>
                        </div>
                        <div class="row">
                            @forelse($berita as $item)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <!-- Cek jika ada gambar -->
                                            @if ($item->gambar)
                                                <img class="card-img-top img-fluid" src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->judul }}" style="height: 20rem" />
                                            @else
                                                <img class="card-img-top img-fluid" src="{{ asset('images/no-image.jpg') }}"
                                                    alt="{{ $item->judul }}" style="height: 20rem" />
                                            @endif
                
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $item->judul }}</h4>
                
                                                <p class="card-text">
                                                    {{ Str::limit($item->deskripsi, 100) }}
                                                </p>
                
                                                <div class="mt-4">
                                                    <a href="{{ route('berita.show', $item->id) }}" class="btn btn-color text-white block">Baca Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 my-5">
                                    <h3 class="text-center">Tidak ada berita</h3>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    </div>
@endsection

@section('additional_scripts')
@endsection
