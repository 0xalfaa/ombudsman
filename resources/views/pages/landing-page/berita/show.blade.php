@extends('pages.landing-page.layouts.main')

{{-- --------------------------------- Title --}}
@section('title', 'Detail Berita - ' . $berita->judul)

{{-- --------------------------------- Links --}}
@section('additional_links')
@endsection

{{-- --------------------------------- Content --}}
@section('content')
    <section class="container px-4">
        <div class="page-heading">
            <div class="page-title">
                <div class="row justify-content-center">
                    <div class="col-12 mb-3 header-about mt-3">
                        <h2>Detail Berita</h2>
                        <p class="text-subtitle text-muted">
                            Berikut adalah informasi lengkap mengenai berita ini.
                        </p>
                        <hr>
                    </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <!-- Menampilkan gambar jika ada -->
                    @if ($berita->gambar)
                        <img class="img-fluid" src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="max-height: 400px; object-fit: cover;" />
                    @else
                        <img class="img-fluid" src="{{ asset('images/no-image.jpg') }}" alt="{{ $berita->judul }}" style="max-height: 400px; object-fit: cover;" />
                    @endif
                    
                    <h3 class="mt-4">{{ $berita->judul }}</h3>
                    <p><strong>Penulis:</strong> {{ $berita->penulis ?? 'Tidak diketahui' }}</p>
                    <p><strong>Tanggal Terbit:</strong> {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') ?? 'Tidak ada tanggal' }}</p>

                    <div class="mt-4">
                        <!-- Menampilkan deskripsi lengkap -->
                        <p class="fs-5 px-sm-5">{!! nl2br(e($berita->deskripsi)) !!}</p>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('berita.index') }}" class="btn btn-color text-white block">Kembali ke Daftar Berita</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- --------------------------------- Scripts --}}
@section('additional_scripts')
@endsection
