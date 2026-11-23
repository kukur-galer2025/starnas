<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | @yield('title', 'Dashboard')</title>

    <!-- Favicon / Ikon Web STARNAS -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .nav-link.active {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
        }
        #admin-sidebar { transition: transform .25s ease; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-100 min-h-screen text-slate-800">
    @php
        $badgeBayar = \App\Models\Pembayaran::where('status', 'pending')->count();
        $badgeAbstrak = \App\Models\Abstrak::where('status_abstrak', 'pending')->count();
        $badgeEmail = \App\Models\EmailLog::where('status', 'gagal')->count();

        $menu = [
            ['Utama', [
                ['admin.dashboard', 'admin.dashboard', 'fa-gauge-high', 'Dashboard', 0, ''],
            ]],
            ['Verifikasi', [
                ['admin.abstracts.index', 'admin.abstracts.*', 'fa-file-lines', 'Abstrak', $badgeAbstrak, 'bg-amber-500'],
                ['admin.payments.index', 'admin.payments.*', 'fa-money-check-dollar', 'Pembayaran', $badgeBayar, 'bg-amber-500'],
            ]],
            ['Komunikasi', [
                ['admin.pengumuman.index', 'admin.pengumuman.*', 'fa-bullhorn', 'Pengumuman', 0, ''],
            ]],
            ['Data & Laporan', [
                ['admin.users.index', 'admin.users.*', 'fa-users', 'Pengguna', 0, ''],
                ['admin.emails.index', 'admin.emails.*', 'fa-envelope-circle-check', 'Status Email', $badgeEmail, 'bg-red-500'],
                ['admin.reports.payments.index', 'admin.reports.payments.*', 'fa-file-invoice-dollar', 'Laporan Pembayaran', 0, ''],
            ]],
        ];
    @endphp

    {{-- Overlay mobile --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="admin-sidebar"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-white flex flex-col -translate-x-full lg:translate-x-0">
        <div class="flex items-center gap-3 px-5 h-16 border-b border-white/10">
            <div class="w-9 h-9 rounded-xl bg-white p-1 flex items-center justify-center">
                <img src="/storage/starnas.png" alt="STARNAS" class="w-full h-full object-contain">
            </div>
            <div class="leading-tight">
                <p class="font-bold text-sm">STARNAS ASASI</p>
                <p class="text-[11px] text-emerald-300">Panel Admin 2026</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-5">
            @foreach($menu as [$grup, $items])
                <div>
                    <p class="px-3 mb-1.5 text-[11px] font-semibold uppercase tracking-wider text-slate-500">{{ $grup }}</p>
                    <div class="space-y-1">
                        @foreach($items as [$route, $pola, $icon, $label, $badge, $warnaBadge])
                            <a href="{{ route($route) }}"
                                class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition {{ Request::routeIs($pola) ? 'active' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                <i class="fas {{ $icon }} w-5 text-center"></i>
                                <span class="flex-1">{{ $label }}</span>
                                @if($badge > 0)
                                    <span class="text-[11px] font-bold {{ $warnaBadge }} text-white px-2 py-0.5 rounded-full">{{ $badge }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-emerald-600 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->nama_lengkap }}</p>
                    <p class="text-[11px] text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 text-sm rounded-xl bg-white/5 text-red-300 hover:bg-red-500/20 transition">
                    <i class="fas fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- KONTEN --}}
    <div class="lg:pl-64 min-h-screen flex flex-col">
        <header class="sticky top-0 z-20 bg-white/90 backdrop-blur border-b border-slate-200">
            <div class="flex items-center gap-3 px-4 md:px-8 h-16">
                <button id="sidebar-toggle" type="button" class="lg:hidden w-10 h-10 rounded-xl hover:bg-slate-100 flex items-center justify-center" aria-label="Buka menu">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <h1 class="flex-1 text-lg md:text-xl font-bold text-slate-800 truncate">@yield('title')</h1>
                <span class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-full" title="Data diperbarui otomatis">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Live
                </span>
                <span class="hidden md:inline text-sm text-slate-500">{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8">
            @foreach([
                'success' => ['bg-emerald-50 border-emerald-200 text-emerald-800', 'fa-circle-check'],
                'error' => ['bg-red-50 border-red-200 text-red-800', 'fa-triangle-exclamation'],
                'warning' => ['bg-amber-50 border-amber-200 text-amber-800', 'fa-circle-exclamation'],
            ] as $key => [$warna, $ikon])
                @if(session($key))
                    <div class="mb-5 flex items-start gap-3 p-4 rounded-xl border {{ $warna }}" role="alert">
                        <i class="fas {{ $ikon }} mt-0.5"></i>
                        <span class="text-sm">{{ session($key) }}</span>
                    </div>
                @endif
            @endforeach

            @if($errors->any())
                <div class="mb-5 p-4 rounded-xl border bg-red-50 border-red-200 text-red-800 text-sm" role="alert">
                    <p class="font-semibold mb-1"><i class="fas fa-triangle-exclamation mr-1"></i> Periksa kembali isian berikut:</p>
                    <ul class="list-disc ml-5 space-y-0.5">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        (function () {
            var sb = document.getElementById('admin-sidebar');
            var ov = document.getElementById('sidebar-overlay');
            function buka(v) {
                sb.classList.toggle('-translate-x-full', !v);
                ov.classList.toggle('hidden', !v);
            }
            document.getElementById('sidebar-toggle').addEventListener('click', function () { buka(true); });
            ov.addEventListener('click', function () { buka(false); });
        })();
    </script>
    @stack('scripts')
    @include('partials.status-sync', ['syncUrl' => route('admin.status.sinkron'), 'syncPesan' => 'Ada data baru / perubahan'])
</body>
</html>
