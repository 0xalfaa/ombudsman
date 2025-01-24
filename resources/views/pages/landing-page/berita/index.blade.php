@extends('pages.landing-page.layouts.main')

{{-- --------------------------------- Title --}}
@section('title', 'Berita')

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
                        <h2>Berita</h2>
                        <p class="text-subtitle text-muted">
                            Daftar seluruh berita.
                        </p>
                        <hr>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="/berita">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-color text-white" id="search-button" type="submit">Cari</button>
                                </div>

                                {{-- If just "page" on params, don't display --}}
                                @if (count(request()->all()) === 1 && array_key_exists('page', request()->all()))
                                    <div class="mb-3 text-center d-none">
                                        <a class="btn btn-color text-white">Tidak ada filters :(</a>
                                    </div>
                                @elseif (!empty(request()->all()))
                                    <div class="mb-3 text-center">
                                        <a class="btn btn-color text-white" href="{{ url()->current([]) }}">Reset
                                            Filters</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
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
                                        {{ Str::limit($item->deskripsi, 100) }} <!-- Menampilkan deskripsi dengan panjang terbatas -->
                                    </p>
        
                                    <div class="mt-4">
                                        <a href="{{ route('berita.show', $item->id) }}" class="btn btn-color text-white block">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="my-5">
                        <h3 class="text-center">Tidak ada berita</h3>
                    </div>
                @endforelse
            </div>
        </div>        

            <div class="row">
                <div class="col d-flex justify-content-center" id="pagin-links">
                    {{ $berita->links('vendor.pagination.bootstrap') }}
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- --------------------------------- Scripts --}}
@section('additional_scripts')
@endsection
