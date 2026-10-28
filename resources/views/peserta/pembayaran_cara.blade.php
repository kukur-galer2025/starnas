@extends('peserta.layouts.main')

@section('title', 'Cara Pembayaran')

@section('content')
    <div class="space-y-8">
        {{-- Peringatan Penting --}}
        <div class="bg-gradient-to-r from-orange-50 to-yellow-50 border-l-4 border-accent text-orange-800 p-6 rounded-2xl shadow-lg" role="alert">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-2xl text-accent"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-2">Penting!</h3>
                    <p class="text-orange-700 leading-relaxed">
                        Pembayaran wajib dilakukan setelah pendaftaran. Mohon ikuti instruksi di bawah ini dengan seksama 
                        dan pastikan jumlah transfer sesuai dengan kategori pendaftaran Anda.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border-t-4 border-secondary">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-money-bill-wave text-secondary text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Biaya Pendaftaran STARNAS ASASI & ICoABCD 2026</h3>
                    <p class="text-gray-600 text-sm mt-1">Pilih kategori sesuai dengan status Anda</p>
                </div>
            </div>
            
            {{-- KATEGORI PEMAKALAH: ONSITE & ONLINE (Dalam grid 2 kolom) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- KATEGORI PEMAKALAH ONSITE --}}
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border border-primary/20 p-4 md:p-6">
                    <div class="text-center mb-6">
                        <h4 class="text-xl font-bold text-primary mb-2">Pemakalah (Onsite)</h4>
                        <p class="text-sm text-gray-500">Presentasi langsung di Grand Hotel De Djokja, Yogyakarta</p>
                        <div class="w-16 h-1 bg-primary rounded-full mx-auto mt-2"></div>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- CARD 1: Anggota ASASI (Onsite) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-user-check text-primary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Anggota ASASI</span>
                            </div>
                            <span class="text-xl font-bold text-secondary w-full md:w-auto text-right md:text-left">Rp 450.000</span>
                        </div>
                        
                        {{-- CARD 2: Umum (Onsite) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-users text-primary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Umum</span>
                            </div>
                            <span class="text-xl font-bold text-secondary w-full md:w-auto text-right md:text-left">Rp 500.000</span>
                        </div>
                        
                        {{-- CARD 3: Mahasiswa (Onsite) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-graduation-cap text-primary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Mahasiswa</span>
                            </div>
                            <span class="text-xl font-bold text-secondary w-full md:w-auto text-right md:text-left">Rp 250.000</span>
                        </div>
                    </div>
                </div>

                {{-- KATEGORI PEMAKALAH ONLINE --}}
                <div class="bg-gradient-to-br from-secondary/5 to-white rounded-xl border border-secondary/20 p-4 md:p-6">
                    <div class="text-center mb-6">
                        <h4 class="text-xl font-bold text-secondary mb-2">Pemakalah (Online)</h4>
                        <p class="text-sm text-gray-500">Presentasi melalui platform virtual</p>
                        <div class="w-16 h-1 bg-secondary rounded-full mx-auto mt-2"></div>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- CARD 1: Anggota ASASI (Online) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-user-check text-secondary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Anggota ASASI</span>
                            </div>
                            <span class="text-xl font-bold text-primary w-full md:w-auto text-right md:text-left">Rp 250.000</span>
                        </div>
                        
                        {{-- CARD 2: Umum (Online) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-users text-secondary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Umum</span>
                            </div>
                            <span class="text-xl font-bold text-primary w-full md:w-auto text-right md:text-left">Rp 300.000</span>
                        </div>
                        
                        {{-- CARD 3: Mahasiswa (Online) --}}
                        <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                                <i class="fas fa-graduation-cap text-secondary mr-3 text-lg"></i>
                                <span class="font-medium text-gray-800">Mahasiswa</span>
                            </div>
                            <span class="text-xl font-bold text-primary w-full md:w-auto text-right md:text-left">Rp 150.000</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KATEGORI NON PRESENTER (Diletakkan di bawah grid agar tidak mengganggu tata letak 2 kolom utama) --}}
            <div class="mt-8">
                <div class="bg-gradient-to-br from-teal-50/60 to-white rounded-xl border border-teal-200 p-4 md:p-6">
                    <div class="text-center mb-6">
                        <h4 class="text-xl font-bold text-teal-700 mb-2">Non Presenter</h4>
                        <p class="text-sm text-gray-500">Peserta tanpa presentasi (Mendapatkan E-Certificate)</p>
                        <div class="w-16 h-1 bg-teal-500 rounded-full mx-auto mt-2"></div>
                    </div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-white rounded-xl border border-teal-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center w-full md:w-auto mb-2 md:mb-0">
                            <i class="fas fa-user-alt text-teal-600 mr-3 text-lg"></i>
                            <span class="font-bold text-gray-800">Biaya Tunggal</span>
                        </div>
                        <span class="text-2xl font-bold text-teal-700 w-full md:w-auto text-right md:text-left">Rp 100.000</span>
                    </div>
                </div>
            </div>
            {{-- Akhir Kategori --}}
        </div>

        <div class="bg-gradient-to-br from-primary/5 to-teal-50/40 rounded-2xl shadow-lg p-6 md:p-8 border border-primary/20">
            <div class="flex items-start mb-6">
                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-university text-primary text-xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Informasi Transfer Bank</h3>
                    <p class="text-gray-600 text-sm mt-1">Lakukan transfer ke rekening berikut</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-4">
                    {{-- Detail Bank --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                        <div class="flex items-center mb-1 sm:mb-0">
                            <i class="fas fa-landmark text-gray-500 mr-3"></i>
                            <span class="font-medium text-gray-700">Bank</span>
                        </div>
                        <span class="font-bold text-primary text-lg"></span>
                    </div>
                    
                    {{-- Detail Rekening --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                        <div class="flex items-center mb-1 sm:mb-0">
                            <i class="fas fa-credit-card text-gray-500 mr-3"></i>
                            <span class="font-medium text-gray-700">Nomor Rekening</span>
                        </div>
                        {{-- Nomor Rekening sudah disesuaikan dengan poster --}}
                        <span class="font-bold text-gray-900 text-lg"></span> 
                    </div>
                    
                    {{-- Detail Atas Nama --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                        <div class="flex items-center mb-1 sm:mb-0">
                            <i class="fas fa-user-tie text-gray-500 mr-3"></i>
                            <span class="font-medium text-gray-700">Atas Nama</span>
                        </div>
                        {{-- Atas Nama sudah disesuaikan dengan poster --}}
                        <span class="font-bold text-gray-900 text-lg"></span>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-red-200 p-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl mt-1"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-red-800 text-lg mb-2">Perhatian!</h4>
                            <ul class="text-red-700 text-sm space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                                    <span>Transfer sesuai dengan kategori pendaftaran Anda</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                                    <span>Simpan bukti transfer untuk diupload di langkah berikutnya</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-red-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                                    <span>Proses verifikasi membutuhkan waktu 1-2 hari kerja</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center pt-6">
            <a href="{{ route('peserta.pembayaran.upload') }}" 
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-lg font-bold rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-cloud-upload-alt mr-3 text-xl"></i>
                Lanjut ke Upload Bukti Transfer
                <i class="fas fa-arrow-right ml-3 text-lg"></i>
            </a>
        </div>
    </div>
@endsection