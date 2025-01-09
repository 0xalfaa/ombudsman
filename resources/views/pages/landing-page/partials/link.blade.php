<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />

{{-- Link ke file CSS --}}
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}" />
<!-- Tambahkan CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Tambahkan JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Fontawesome --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">

{{-- Vite untuk file CSS tambahan --}}
@vite('resources/css/app.css')
