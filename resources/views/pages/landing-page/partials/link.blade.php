<link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />

{{-- Link ke file CSS --}}
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}" />
{{-- Fontawesome --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">

{{-- Vite untuk file CSS tambahan --}}
@vite('resources/css/app.css')
