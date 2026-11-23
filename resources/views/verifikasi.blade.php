<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Verifikasi Dokumen - STARNAS ASASI 2026</title>
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
    <div class="w-full max-w-lg">
        <div class="flex items-center justify-center gap-3 mb-6">
            <span class="w-11 h-11 rounded-xl bg-white p-1.5 flex items-center justify-center shadow-lg">
                <img src="{{ asset('storage/starnas.png') }}" alt="STARNAS" class="w-full h-full object-contain">
            </span>
            <span class="text-white leading-tight">
                <span class="block font-bold">STARNAS ASASI 2026</span>
                <span class="block text-xs text-emerald-300">Verifikasi Keaslian Dokumen</span>
            </span>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            @if($data)
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5 text-white flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fas fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-emerald-100 font-semibold">{{ $data['tipe'] }}</p>
                        <h1 class="text-lg font-extrabold leading-tight">Dokumen ASLI &amp; Terdaftar</h1>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-slate-600 mb-4">
                        {{ $data['judul'] }} ini diterbitkan oleh Panitia STARNAS ASASI 2026 dan tercatat di sistem kami.
                    </p>
                    <dl class="divide-y divide-slate-100 border border-slate-200 rounded-xl">
                        @foreach($data['baris'] as $label => $nilai)
                            <div class="grid grid-cols-3 gap-3 px-4 py-2.5 text-sm">
                                <dt class="text-slate-500 font-medium">{{ $label }}</dt>
                                <dd class="col-span-2 font-semibold text-slate-900 break-words">{{ $nilai }}</dd>
                            </div>
                        @endforeach
                    </dl>
                    <p class="text-xs text-slate-500 mt-4">
                        <i class="fas fa-shield-halved mr-1 text-emerald-600"></i>
                        Pastikan data di atas sama dengan yang tertulis pada dokumen. Bila berbeda, dokumen tersebut tidak asli.
                    </p>
                </div>
            @else
                <div class="bg-gradient-to-r from-red-500 to-rose-500 px-6 py-5 text-white flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-2xl flex-shrink-0">
                        <i class="fas fa-circle-xmark"></i>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-red-100 font-semibold">Verifikasi gagal</p>
                        <h1 class="text-lg font-extrabold leading-tight">Dokumen Tidak Ditemukan</h1>
                    </div>
                </div>
                <div class="p-6 text-sm text-slate-600 space-y-2">
                    <p>Kode verifikasi ini tidak terdaftar atau dokumen sudah tidak berlaku.</p>
                    <p>Bila Anda menerima dokumen dengan kode ini, kemungkinan dokumen tersebut <strong>tidak asli</strong>.
                        Hubungi panitia untuk konfirmasi.</p>
                    <p class="text-xs text-slate-400 break-all">Kode: {{ $kode }}</p>
                </div>
            @endif
        </div>

        <p class="text-center text-xs text-emerald-200/80 mt-5">
            <a href="{{ url('/') }}" class="font-semibold text-emerald-300 hover:text-white">starnas.asasi.or.id</a>
            &middot; Seminar Teknologi dan Sains Nasional ASASI 2026
        </p>
    </div>
</body>
</html>
