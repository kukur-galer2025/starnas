<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | @yield('title', 'Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#059669',
                        secondary: '#10b981',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar {
            transition: all 0.3s ease;
        }
        .nav-link.active {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 flex min-h-screen">

    <aside class="sidebar w-64 bg-gray-900 text-white flex flex-col p-4 shadow-2xl border-r border-gray-800">
        <div class="text-2xl font-bold mb-8 text-emerald-400">
            <i class="fas fa-screwdriver-wrench mr-2"></i> Admin Panel
        </div>
        <nav class="flex-grow space-y-2">
            
            <a href="{{ route('admin.dashboard') }}" 
                class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.dashboard') ? 'active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </a>
            
            <h4 class="text-xs font-semibold uppercase text-gray-500 pt-4 pb-1">Manajemen Data</h4>

            <a href="{{ route('admin.users.index') }}" 
                class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.users.*') ? 'active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-users mr-3"></i> User Terdaftar
            </a>

            <a href="{{ route('admin.payments.index') }}" 
                class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.payments.*') ? 'active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-check-double mr-3"></i> Verifikasi Pembayaran
                {{-- Placeholder untuk Notifikasi Pending --}}
                @inject('pendingCount', 'App\Models\Pembayaran')
                @if($pendingCount::where('status', 'pending')->count() > 0)
                    <span class="ml-auto text-xs font-bold bg-red-500 text-white px-2 py-0.5 rounded-full">
                        {{ $pendingCount::where('status', 'pending')->count() }}
                    </span>
                @endif
            </a>
            
            <!-- BAGIAN BARU: Verifikasi Abstrak -->
            <a href="{{ route('admin.abstracts.index') }}" class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.abstracts.*') ? 'active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-file-alt mr-3"></i> Verifikasi Abstrak
                {{-- PERBAIKAN: Menggunakan Model Abstrak --}}
                @inject('pendingAbstracts', 'App\Models\Abstrak') 
                
                {{-- Query diubah untuk mencari di tabel abstracts --}}
                @if($pendingAbstracts::where('status_abstrak', 'pending')->count() > 0)
                    <span class="ml-auto text-xs font-bold bg-red-500 text-white px-2 py-0.5 rounded-full">
                        {{ $pendingAbstracts::where('status_abstrak', 'pending')->count() }}
                    </span>
                @endif
            </a>
            
            {{-- BAGIAN BARU: LAPORAN --}}
            <h4 class="text-xs font-semibold uppercase text-gray-500 pt-4 pb-1">Laporan</h4>
            
            <a href="{{ route('admin.reports.payments.index') }}" 
                class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.reports.payments.*') ? 'active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-file-invoice-dollar mr-3"></i> Laporan Pembayaran
            </a>
            
            {{-- Tombol Export PDF lama (jika ingin tetap ada sebagai alternatif) --}}
            {{-- <a href="{{ route('admin.reports.payments.export-pdf') }}" 
                class="nav-link flex items-center p-3 rounded-lg transition duration-150 
                {{ Request::routeIs('admin.reports.*') ? 'active' : 'hover:bg-gray-700' }}"
                target="_blank">
                <i class="fas fa-file-pdf mr-3"></i> Laporan Pembayaran (PDF)
            </a> --}}
            {{-- END BAGIAN BARU --}}

        </nav>
        
        <div class="mt-8 pt-4 border-t border-gray-700">
            <p class="text-sm text-gray-400 mb-2">Login sebagai: {{ Auth::user()->email }}</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left p-3 text-sm rounded-lg text-red-400 hover:bg-gray-700 transition duration-150">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-grow p-8">
        <header class="bg-white p-6 rounded-xl shadow-md mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">@yield('title')</h1>
            <p class="text-gray-500">{{ date('l, d F Y') }}</p>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded-lg" role="alert">
                {{ session('warning') }}
            </div>
        @endif

        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>