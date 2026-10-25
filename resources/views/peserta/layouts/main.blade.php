<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Peserta | @yield('title', 'Beranda')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#059669',
                        'primary-dark': '#047857',
                        'secondary': '#10b981',
                        'accent': '#f59e0b',
                        'emerald-dark': '#022c22',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #050b14 0%, #064e3b 55%, #047857 100%);
        }
        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }
        /* Menyesuaikan active class dengan penamaan file Anda */
        .nav-item.active {
             background: linear-gradient(135deg, #059669 0%, #10b981 100%);
             color: white;
             font-weight: 600;
             box-shadow: 0 4px 14px rgba(5, 150, 105, 0.25);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: #f59e0b;
            border-radius: 0 2px 2px 0;
        }
        .status-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .status-card:hover {
            transform: translateY(-2px);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-poppins flex flex-col min-h-screen">

    <header class="gradient-bg text-white shadow-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('peserta.beranda') }}" class="flex-shrink-0 flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-white group-hover:text-accent transition-colors duration-300">STARNAS ASASI 2026</span>
                        <p class="text-xs text-white/80 -mt-1">Dashboard Peserta</p>
                    </div>
                </a>

                {{-- DROPDOWN MENU PROFIL & LOGOUT --}}
                <div class="flex items-center space-x-2 relative" x-data="{ open: false }">
                    
                    {{-- TOMBOL DROPDOWN PROFIL --}}
                    <button @click="open = !open" 
                            class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl px-4 py-2.5 transition-all duration-300 shadow-lg cursor-pointer">
                        <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-white font-medium hidden md:inline">{{ Auth::user()->nama_lengkap ?? 'Peserta' }}</span>
                        <i class="fas fa-chevron-down text-white text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>

                    {{-- DROPDOWN MENU --}}
                    <div x-show="open" @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 top-full w-48 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 origin-top-right">
                        <div class="py-1">
                            
                            {{-- Menu Edit Profil --}}
                            <a href="{{ route('peserta.profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary transition duration-150">
                                <i class="fas fa-id-card w-4 h-4 mr-3"></i> Edit Profil
                            </a>

                            {{-- Menu Logout --}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-150">
                                    <i class="fas fa-sign-out-alt w-4 h-4 mr-3"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <aside class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-compass mr-3 text-primary"></i>
                            Navigasi Menu
                        </h3>
                        
                        <nav class="space-y-3">
                            <a href="{{ route('peserta.beranda') }}" 
                               class="nav-item flex items-center p-4 text-base font-medium rounded-xl transition-all duration-300 
                               @if(Request::routeIs('peserta.beranda')) active bg-primary/5 text-white border-l-4 border-primary @else text-gray-600 hover:bg-gray-50 hover:text-primary hover:border-l-4 hover:border-primary/50 @endif">
                               <i class="fas fa-home w-5 h-5 mr-4"></i>
                               Beranda
                            </a>

                            <a href="{{ route('peserta.pembayaran.cara') }}" 
                               class="nav-item flex items-center p-4 text-base font-medium rounded-xl transition-all duration-300 
                               @if(Request::routeIs('peserta.pembayaran.cara')) active bg-primary/5 text-white border-l-4 border-primary @else text-gray-600 hover:bg-gray-50 hover:text-primary hover:border-l-4 hover:border-primary/50 @endif">
                               <i class="fas fa-file-invoice-dollar w-5 h-5 mr-4"></i>
                               Cara Pembayaran
                            </a>
                            
                            <a href="{{ route('peserta.pembayaran.upload') }}" 
                               class="nav-item flex items-center p-4 text-base font-medium rounded-xl transition-all duration-300 
                               @if(Request::routeIs('peserta.pembayaran.upload')) active bg-primary/5 text-white border-l-4 border-primary @else text-gray-600 hover:bg-gray-50 hover:text-primary hover:border-l-4 hover:border-primary/50 @endif">
                               <i class="fas fa-cloud-upload-alt w-5 h-5 mr-4"></i>
                               Upload Bukti
                            </a>
                            
                             <a href="{{ route('peserta.abstrak.upload') }}"
                                class="nav-item flex items-center p-4 text-base font-medium rounded-xl transition-all duration-300 
                               @if(Request::routeIs('peserta.abstrak.upload')) active bg-primary/5 text-white border-l-4 border-primary @else text-gray-600 hover:bg-gray-50 hover:text-primary hover:border-l-4 hover:border-primary/50 @endif">
                                <i class="fas fa-cloud-upload-alt w-5 h-5 mr-4"></i>
                                Upload Abstrak
                            </a>

                            <a href="{{ route('peserta.riwayat') }}" 
                               class="nav-item flex items-center p-4 text-base font-medium rounded-xl transition-all duration-300 
                               @if(Request::routeIs('peserta.riwayat')) active bg-primary/5 text-white border-l-4 border-primary @else text-gray-600 hover:bg-gray-50 hover:text-primary hover:border-l-4 hover:border-primary/50 @endif">
                               <i class="fas fa-history w-5 h-5 mr-4"></i>
                               Riwayat Status
                            </a>
                        </nav>
                    </div>
                </aside>

                <div class="lg:col-span-9">
                    
                    {{-- Alert Messages --}}
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-xl shadow-md" role="alert">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-xl shadow-md" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <div class="mb-8">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                                @yield('title', 'Beranda Peserta')
                            </h1>
                            <div class="w-20 h-1 bg-gradient-to-r from-primary to-accent rounded-full"></div>
                        </div>

                        @yield('content')

                        @if(Request::routeIs('peserta.pembayaran.upload'))
                            <div class="mt-8 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-emerald-600 mt-1"></i>
                                    <div>
                                        <h4 class="font-semibold text-emerald-900 text-sm">Informasi Upload</h4>
                                        <p class="text-emerald-800 text-xs mt-1">
                                            Batasan: File bukti pembayaran maksimal <strong>10 MB</strong>. Format yang disarankan: JPG, PNG, atau PDF.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-10 h-10 bg-accent rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white"></i>
                    </div>
                    <div>
                        <span class="font-bold text-lg">STARNAS ASASI & ICoABCD 2026</span>
                        <p class="text-gray-400 text-xs">Seminar Teknologi dan Sains Nasional</p>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400 text-sm">
                        &copy; {{ date('Y') }} Aplikasi Peserta STARNAS ASASI & ICoABCD 2026. Hak Cipta Dilindungi.
                    </p>
                    <p class="text-gray-500 text-xs mt-1">
                        Dibangun dengan ❤️ untuk kemajuan pendidikan Indonesia
                    </p>
                </div>
            </div>
        </div>
    </footer>

    {{-- Alpine.js untuk fungsionalitas dropdown --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>