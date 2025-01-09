@extends('pages.landing-page.layouts.main')

{{-- --------------------------------- Title --}}
@section('title', 'Tentang')

{{-- --------------------------------- Links --}}
@section('additional_links')
@endsection

{{-- --------------------------------- Content --}}
@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 mb-3 header-about bg-about">
                <div class="container text-center mt-2 mt-sm-5">
                    <h1 class="text-white">Apa Itu OMBUDSMAN ?</h1>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/1KrGsxjJNjA?si=YljCLx9BF8uF0oF6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-12">
                <div class="container mt-4 text-center ">
                    <p class="fs-5 px-sm-5">
                        OMBUDSMAN adalah Lembaga Negara yang mempunyai kewenangan mengawasi Penyelenggaraan Pelayanan Publik baik yang diselenggarakan oleh penyelenggara Negara dan pemerintahan termasuk yang diselenggarakan oleh Badan Usaha Miliki Negara, Badan Usaha Milik Daerah, dan Badan Hukum milik Negara serta Badan Swasta atau perseorangan yang diberi tugas menyelenggarakan pelayanan publik tertentu yang sebagian atau seluruh dananya bersumber dari anggaran pendapatan dan belanja Negara dan/atau anggaran pendapatan dan belanja daerah (Pasal 1 Undang-Undang Republik Indonesia Nomor 37 Tahun 2008 Tentang Ombudsman Republik Indonesia).
                    </p>
                    <h2 class="mt-5 mb-4">
                        Sejarah Ombudsman di Indonesia
                    </h2>
                    <p class="fs-5 px-sm-5">
                        Kelahiran Ombudsman di Indonesia merupakan tuntutani era reformasi akan pemerintahan yang bersih, transparan dan bebas dari korupsi, kolusi dan nepotisme. Pemerintah pada saat itu melakukan beberapa upaya perubahan untuk menampung aspirasi masyarakat, salah satunya dengan membentuk lembaga pengawasan Penyelenggaraan Negara melalui Keputusan Presiden Nomor 44 Tahun 2000 tentang pembentukan Komisi Ombudsman Nasional tertanggal 10 Maret 2000.

                        Kedudukan Ombudsman RI semakin diperkuat dengan ditandatanganinya Undang-Undang Nomor 37 Tahun 2008 tentang Ombudsman Republik Indonesia. Dengan adanya Undang-Undang ini, instistusi Komisi Ombudsman Nasional berubah nama menjadi Ombudsman RI. Kemudian, dibentuk juga Undang-Undang Nomor 25 Tahun 2009 tentang Pelayanan Publik. Undang-Undang ini dibentuk untuk menciptakan kebaikan, menjamin keadilan dan ketertiban dalam kehidupan bermasyarakat atau good governance dan clean governance.
                    </p>

                    <div class="text-center">
                        <h2 class=" my-5">
                            Lokasi
                        </h2>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.156895300785!2d114.58645577497194!3d-3.3113499966634903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de423b8b647b8cf%3A0xde3e830795fff0de!2sOmbudsman%20RI%20Perwakilan%20Kalsel!5e0!3m2!1sid!2sid!4v1730013425975!5m2!1sid!2sid" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- --------------------------------- Scripts --}}
@section('additional_scripts')
@endsection
