@extends('pages.landing-page.layouts.main')

{{-- --------------------------------- Title --}}
@section('title', 'Kontak')

{{-- --------------------------------- Links --}}
@section('additional_links')
@endsection

{{-- --------------------------------- Content --}}
@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-6 mb-3 header-about bg-home w-100 pb-5">
                <div class="container pt-2 pt-sm-5">
                    <div class="row d-flex align-items-center text-sm-start text-center">
                        <div class="col-md-6 col-12" style="z-index: 10">
                            <h1 class="text-white fw-bold">Kontak Kami</h1>
                            <p class="text-white fs-5 pt-3 pt-sm-4 w-100">
                                Hubungi kami untuk informasi lebih lanjut atau jika Anda memiliki pertanyaan
                            </p>
                        </div>
                        <div class="col text-center text-md-end mt-5 mt-sm-0">
                            <img src="{{ asset('images/contact.png') }}" alt="illustrasi kontak" class="illust-home"
                                width="70%">
                        </div>
                    </div>
                    <div class="poligon d-none d-md-block"></div>
                </div>
            </div>

            <div class="col-12 text-center">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12 mt-5 mb-4 text-center">
                            <h4 class="mt-5 mb-3">Kantor Ombudsman Kalsel</h4>
                            <p class="fs-6">Jl. S. Parman No.57, Antasan Besar, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan</p>
                            <h4 class="mt-5 mb-3">Customer Service</h4>
                            <p class="fs-6 mb-1">Telepon: (021) 137 / (0511) 3367412</p>
                            <p class="fs-6 mb-1">Email: <a href="mailto:kalsel@ombudsman.go.id">kalsel@ombudsman.go.id</a></p>
                            <h4 class="mt-5 mb-2">Media Sosial</h4>
                            <p class="fs-6 mb-4">Tetap terhubung dengan kami dan dapatkan informasi terbaru mengenai Ombudsman RI Perwakilan Kalsel</p>
                            <p class="fs-6 mb-1">Instagram: <a href="https://www.instagram.com/ombudsmankalsel/" target="_blank">@ombudsmankalsel</a></p>
                            <p class="fs-6 mb-1">Facebook: <a href="https://www.facebook.com/ombudsmankalsel/" target="_blank">@ombudsmankalsel</a></p>
                            <p class="fs-6 mb-1">WhatsApp: <a href="https://wa.me/+628111653737" target="_blank"> 08111653737</a></p>
                        </div>
    
                        <!-- Saran Form Section -->

                        <h4 class="mt-5 mb-4">Saran</h4>
                        <form action="{{ route('saran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Input untuk isi saran -->
                            <div class="mb-3">
                                <textarea name="isi" class="form-control" rows="4" placeholder="Tulis saran Anda di sini..." required></textarea>
                                @error('isi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Input untuk file -->
                            <div class="mb-3">
                                <input type="file" name="file" class="form-control">
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Tombol submit -->
                            <button type="submit" class="btn btn-primary">Kirim Saran</button>
                        </form>
                        
                        </div> 
                    </div>
            </div>
        </section>
    </div>
@endsection

{{-- --------------------------------- Scripts --}}
@section('additional_scripts')
@endsection
