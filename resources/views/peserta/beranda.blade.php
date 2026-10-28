@extends('peserta.layouts.main')

@section('title', 'Beranda & Informasi STARNAS ASASI & ICoABCD 2026')

@section('content')
    <!-- Welcome Alert -->
    <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 text-white p-6 rounded-2xl shadow-lg mb-8" role="alert">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <i class="fas fa-rocket text-2xl text-accent"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-lg mb-1">Selamat datang di Dashboard Peserta!</h3>
                <p class="text-emerald-100 leading-relaxed">
                    Gunakan menu navigasi di samping untuk melanjutkan proses pendaftaran dan pembayaran Anda. 
                    Pastikan semua persyaratan telah dipenuhi untuk pengalaman STARNAS ASASI & ICoABCD 2026 yang optimal.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <!-- Main Information Section -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Event Information Card -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-700 to-teal-600 p-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Informasi Utama Acara
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-lg font-bold text-gray-800 flex items-center">
                            <i class="fas fa-bullhorn text-amber-500 mr-2"></i>
                            Banner Resmi Seminar Nasional ASASI 2026
                        </h4>
                        <a href="{{ asset('storage/banner-starnas-2026.jpeg') }}" target="_blank"
                            class="text-xs text-emerald-700 hover:text-emerald-800 font-bold bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200 flex items-center gap-1 transition-colors">
                            <i class="fas fa-search-plus"></i> Lihat Ukuran Penuh
                        </a>
                    </div>
                    
                    <div class="mt-2 border-2 border-emerald-500/30 rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-[1.01] bg-slate-900">
                        <img src="{{ asset('storage/banner-starnas-2026.jpeg') }}" 
                             alt="Banner Resmi Seminar Nasional ASASI 2026" 
                             class="w-full h-auto object-contain">
                    </div>

                    <div class="mt-3 flex flex-col sm:flex-row gap-2.5">
                        <a href="{{ asset('storage/banner-starnas-2026.jpeg') }}" download="Banner_Seminar_Nasional_ASASI_2026.jpeg"
                            class="flex-1 py-2 px-3 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl text-center flex items-center justify-center gap-1.5 shadow-sm transition-all">
                            <i class="fas fa-download"></i> Unduh Banner Resmi 2026
                        </a>
                        <a href="{{ asset('storage/brosur-starnas-2026.jpg') }}" target="_blank"
                            class="flex-1 py-2 px-3 bg-white border border-emerald-300 hover:bg-emerald-50 text-emerald-800 text-xs font-bold rounded-xl text-center flex items-center justify-center gap-1.5 shadow-sm transition-all">
                            <i class="fas fa-image"></i> Lihat Poster ICoABCD 2026
                        </a>
                    </div>

                    <!-- Event Details -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center p-3 bg-emerald-50 rounded-lg">
                            <i class="fas fa-calendar-alt text-primary mr-3"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Tanggal</p>
                                <p class="text-xs text-gray-600 font-bold">1-2 Desember 2026</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <i class="fas fa-map-marker-alt text-secondary mr-3"></i>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Lokasi</p>
                                <p class="text-xs text-gray-600 font-bold">Grand Hotel De Djokja, Yogyakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="bg-gradient-to-br from-emerald-50 via-teal-50/50 to-emerald-100/40 border border-emerald-200/80 rounded-2xl p-6 shadow-lg">
                <h4 class="text-lg font-bold text-emerald-950 mb-3 flex items-center">
                    <i class="fas fa-lightbulb text-accent mr-2"></i>
                    Tentang STARNAS ASASI & ICoABCD 2026
                </h4>
                <p class="text-emerald-800 leading-relaxed">
                    <strong>STARNAS ASASI & ICoABCD 2026</strong> adalah Seminar Teknologi dan Sains Nasional yang diselenggarakan 
                    dengan tema <strong>AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi</strong>. 
                    Acara ini menghadirkan pakar, regulator, praktisi, dan akademisi terkemuka dari seluruh Indonesia.
                </p>
                <div class="mt-4 flex items-center text-sm text-emerald-700 font-medium">
                    <i class="fas fa-robot mr-2 text-emerald-600"></i>
                    <span>AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi</span>
                </div>
            </div>
        </div>

        <!-- Status Section -->
        <div class="xl:col-span-1 space-y-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-chart-line text-primary mr-2"></i>
                Status Pendaftaran
            </h3>

            <!-- Registration Status -->
            <div class="status-card bg-white rounded-2xl shadow-lg p-6 border-t-4 border-secondary transform transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-base font-semibold text-gray-900">Status Pendaftaran</h3>
                    <i class="fas fa-user-check text-secondary text-lg"></i>
                </div>
                <p class="text-2xl font-bold text-secondary mb-2">Aktif</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-secondary h-2 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Pendaftaran Anda telah aktif</p>
            </div>
            
            <!-- Payment Status -->
            <div class="status-card bg-white rounded-2xl shadow-lg p-6 border-t-4 
                @if(!$pembayaran) border-red-500 
                @elseif($pembayaran->status == 'pending') border-orange-500 
                @elseif($pembayaran->status == 'verified') border-green-500 
                @else border-red-500 @endif transform transition-all duration-300">
                
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-base font-semibold text-gray-900">Status Pembayaran</h3>
                    <i class="fas @if(!$pembayaran) fa-times-circle text-red-500 
                        @elseif($pembayaran->status == 'pending') fa-clock text-orange-500 
                        @elseif($pembayaran->status == 'verified') fa-check-circle text-green-500 
                        @else fa-times-circle text-red-500 @endif text-lg"></i>
                </div>
                
                @if(!$pembayaran)
                    <p class="text-2xl font-bold text-red-500 mb-2">Belum Ada Bukti</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Silakan upload bukti pembayaran</p>
                @elseif($pembayaran->status == 'pending')
                    <p class="text-2xl font-bold text-orange-500 mb-2">Menunggu Verifikasi</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 50%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Bukti pembayaran sedang diverifikasi</p>
                @elseif($pembayaran->status == 'verified')
                    <p class="text-2xl font-bold text-green-500 mb-2">Terverifikasi</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Pembayaran telah dikonfirmasi</p>
                @else
                    <p class="text-2xl font-bold text-red-500 mb-2">Ditolak</p>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 25%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Silakan upload ulang bukti pembayaran</p>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-r from-gray-50 to-white rounded-2xl shadow-lg p-5 border border-gray-200">
                <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-accent mr-2"></i>
                    Akses Cepat
                </h4>
                <div class="space-y-3">
                    <a href="{{ route('peserta.pembayaran.upload') }}" 
                       class="flex items-center justify-between p-3 bg-primary/5 hover:bg-primary/10 rounded-xl transition-colors duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-upload text-primary mr-3"></i>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-primary">Upload Bukti</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-primary text-xs"></i>
                    </a>
                    <a href="{{ route('peserta.pembayaran.cara') }}" 
                       class="flex items-center justify-between p-3 bg-secondary/5 hover:bg-secondary/10 rounded-xl transition-colors duration-300 group">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-secondary mr-3"></i>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-secondary">Panduan</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 group-hover:text-secondary text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection