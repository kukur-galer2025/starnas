@extends('peserta.layouts.main')

@section('title', 'Riwayat Status & Transaksi')

@section('content')
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-history text-primary text-lg"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Riwayat Status & Transaksi</h1>
                    <p class="text-gray-600 text-sm mt-1">Lacak semua pengajuan bukti pembayaran dan abstrak Anda</p>
                </div>
            </div>
        </div>

        {{-- Notifikasi Error (jika gagal download kwitansi) --}}
        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 text-red-800 p-6 rounded-2xl shadow-lg mb-6"
                role="alert">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                    <div>
                        <p class="font-semibold">Peringatan</p>
                        <p class="text-sm mt-1">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- =============================================== --}}
        {{-- == RIWAYAT STATUS ABSTRAK (KARTU BARU) == --}}
        {{-- =============================================== --}}
        @if(isset($abstrak) && $abstrak)
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-teal-500">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-file-alt mr-3 text-teal-600"></i> Status Abstrak
                    </h3>
                    <a href="{{ route('peserta.abstrak.upload') }}" class="text-xs text-primary hover:text-emerald-700 font-medium">
                        Lihat Detail
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Judul Abstrak</p>
                        <p class="text-base font-semibold text-gray-900 leading-relaxed">{{ $abstrak->judul_abstrak }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status Verifikasi</p>
                        @php
                            $status = $abstrak->status_abstrak;
                            $statusData = [
                                'pending' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Menunggu Review'],
                                'diterima' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Diterima'],
                                'ditolak' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Ditolak'],
                            ];
                            $currentStatus = $statusData[$status] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Data Kosong'];
                        @endphp
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $currentStatus['class'] }}">
                            {{ $currentStatus['text'] }}
                        </span>
                    </div>
                </div>

                @if($abstrak->catatan_reviewer_abstrak)
                    <div class="mt-4 p-3 rounded-lg border {{ $status == 'ditolak' ? 'bg-red-50 border-red-200' : 'bg-gray-50 border-gray-200' }}">
                        <strong class="text-sm text-gray-600">Catatan Reviewer:</strong>
                        <p class="text-sm {{ $status == 'ditolak' ? 'text-red-700' : 'text-gray-800' }} mt-1 italic">
                            {{ $abstrak->catatan_reviewer_abstrak }}
                        </p>
                    </div>
                @endif
            </div>
        @else
            <div class="p-4 bg-teal-50 border border-teal-200 rounded-xl text-teal-800">
                <i class="fas fa-exclamation-circle mr-2 text-teal-600"></i> Anda belum mengunggah abstrak. Silakan unggah di halaman Upload Abstrak.
            </div>
        @endif
        {{-- =============================================== --}}
        {{-- == AKHIR RIWAYAT STATUS ABSTRAK == --}}
        {{-- =============================================== --}}

        @if($riwayat_pembayaran->isEmpty())
            {{-- Empty State Pembayaran --}}
            <div
                class="bg-gradient-to-br from-emerald-50 to-teal-50 border-l-4 border-primary text-emerald-950 p-8 rounded-2xl shadow-lg text-center">
                <div class="max-w-md mx-auto">
                    <div class="w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-invoice-dollar text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Belum Ada Riwayat Pembayaran</h3>
                    <p class="text-emerald-800 mb-6 leading-relaxed">
                        Anda belum pernah mengunggah bukti pembayaran. Segera unggah bukti transfer Anda
                        untuk memulai proses verifikasi.
                    </p>
                    <a href="{{ route('peserta.pembayaran.upload') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg shadow-emerald-600/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-cloud-upload-alt mr-3"></i>
                        Upload Bukti Pembayaran
                    </a>
                </div>
            </div>
        @else
            {{-- Riwayat Table Pembayaran --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                {{-- Table Header --}}
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Submission Pembayaran</h3>
                        <div class="text-sm text-gray-500">
                            Menampilkan {{ $riwayat_pembayaran->count() }} entri
                        </div>
                    </div>
                </div>

                {{-- Table Content --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                        Tanggal Upload
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">
                                    <div class="flex items-center">
                                        <i class="fas fa-tasks mr-2"></i>
                                        Status Verifikasi
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">
                                    <div class="flex items-center">
                                        <i class="fas fa-cog mr-2"></i>
                                        Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($riwayat_pembayaran as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $item->created_at->format('H:i') }} WIB
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusData = [
                                                    'pending' => ['class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fas fa-clock'],
                                                    'verified' => ['class' => 'bg-green-100 text-green-800', 'icon' => 'fas fa-check-circle'],
                                                    'rejected' => ['class' => 'bg-red-100 text-red-800', 'icon' => 'fas fa-times-circle'],
                                                ];
                                                $currentStatus = $statusData[$item->status] ?? ['class' => 'bg-gray-100 text-gray-800', 'icon' => 'fas fa-question-circle'];
                                            @endphp
                                            <span
                                                    class="px-3 py-1.5 inline-flex items-center text-xs leading-5 font-bold rounded-full {{ $currentStatus['class'] }} border">
                                                <i class="{{ $currentStatus['icon'] }} mr-1.5"></i>
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4"> {{-- Hapus whitespace-nowrap di sini --}}
                                            <div class="flex flex-col space-y-3">
                                                {{-- PERBAIKAN 1: Tombol lebih besar (py-3) dan teks lebih besar (text-base) --}}
                                                <a href="{{ route('peserta.payments.view-bukti', $item->id) }}" target="_blank"
                                                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-primary/10 hover:bg-primary/20 text-primary font-bold rounded-2xl text-base transition-colors duration-200 group shadow-md hover:shadow-lg">
                                                    <i class="fas fa-eye mr-2"></i>
                                                    Lihat Bukti
                                                </a>

                                                {{-- JIKA DITOLAK, MUNCUL TOMBOL UPLOAD ULANG --}}
                                                @if($item->status == 'rejected')
                                                    {{-- PERBAIKAN 2: Tombol lebih besar (py-3) dan teks lebih besar (text-base) --}}
                                                    <a href="{{ route('peserta.pembayaran.upload') }}"
                                                        class="inline-flex items-center justify-center w-full px-4 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl text-base transition-colors duration-200 group shadow-md hover:shadow-lg">
                                                        <i class="fas fa-redo mr-2"></i>
                                                        Upload Ulang
                                                    </a>
                                                @endif

                                                {{-- TOMBOL UNDUH KWITANSI & SERTIFIKAT --}}
                                                @if($item->status == 'verified')
                                                    {{-- PERBAIKAN 3: Tombol lebih besar (py-3) dan teks lebih besar (text-base) --}}
                                                    <a href="{{ route('peserta.kwitansi.download', $item->id) }}"
                                                        class="inline-flex items-center justify-center w-full px-4 py-3 bg-secondary hover:bg-green-600 text-white font-bold rounded-2xl text-base transition-colors duration-200 group shadow-md hover:shadow-lg">
                                                        <i class="fas fa-download mr-2"></i>
                                                        Unduh Kwitansi
                                                    </a>
                                                    
                                                    {{-- PERBAIKAN 4: Tombol lebih besar (py-3) dan teks lebih besar (text-base) --}}
                                                    <a href="{{ route('peserta.sertifikat.download') }}"
                                                        class="inline-flex items-center justify-center w-full px-4 py-3 bg-primary hover:bg-emerald-700 text-white font-bold rounded-2xl text-base transition-colors duration-200 group shadow-md hover:shadow-lg">
                                                        <i class="fas fa-award mr-2"></i>
                                                        Unduh Sertifikat
                                                    </a>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>

                                    {{-- BARIS BARU untuk Catatan Admin (Memanjang di luar kolom data) --}}
                                    @if($item->catatan_admin)
                                        <tr class="bg-gray-50 border-t border-gray-100">
                                            <td colspan="3" class="px-6 py-3 text-sm">
                                                <div class="flex items-start">
                                                    <div
                                                        class="w-2 h-2 rounded-full mt-2 mr-3 {{ $item->status == 'rejected' ? 'bg-red-500' : 'bg-green-500' }}">
                                                    </div>
                                                    <div>
                                                        <strong class="text-gray-600">Catatan Admin:</strong>
                                                        <span class="text-gray-800 italic leading-relaxed">{{ $item->catatan_admin }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- END BARIS BARU --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-gradient-to-r from-emerald-50 via-teal-50/50 to-emerald-100/40 rounded-2xl shadow-lg p-6 border border-emerald-200">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <i class="fas fa-question-circle text-emerald-600 text-2xl mt-1"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800 text-lg mb-2">Butuh Bantuan?</h4>
                        <p class="text-gray-700 mb-4">
                            Jika Anda memiliki pertanyaan tentang status verifikasi atau mengalami kendala teknis,
                            jangan ragu untuk menghubungi tim support kami.
                        </p>
                        <a href="https://wa.me/628122718132" target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
            border-radius: 3px;
        }
    </style>
@endsection