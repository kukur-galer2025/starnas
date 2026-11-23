<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - STARNAS ASASI & ICoABCD 2026</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 10% 20%, #064e3b 0%, #050b14 60%, #022c22 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <a href="{{ url('/') }}" class="flex items-center justify-center gap-3 mb-6">
            <span class="w-11 h-11 rounded-xl bg-white p-1.5 flex items-center justify-center shadow-lg">
                <img src="{{ asset('storage/starnas.png') }}" alt="STARNAS" class="w-full h-full object-contain">
            </span>
            <span class="text-white leading-tight">
                <span class="block font-bold">STARNAS ASASI 2026</span>
                <span class="block text-xs text-emerald-300">Seminar Teknologi dan Sains Nasional</span>
            </span>
        </a>

        <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
            @yield('content')
        </div>

        <p class="text-center text-xs text-emerald-200/80 mt-5">
            Butuh bantuan? <a href="https://wa.me/6285225519882" target="_blank" class="font-semibold text-emerald-300 hover:text-white">Hubungi admin via WhatsApp</a>
        </p>
    </div>
    @include('partials.password-toggle')
</body>
</html>
