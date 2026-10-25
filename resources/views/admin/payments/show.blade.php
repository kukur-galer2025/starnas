@extends('admin.layouts.app')

@section('title', 'Detail Verifikasi Pembayaran')

@section('content')
    {{-- Script JS untuk toggle form --}}
    @push('scripts')
    <script>
        // Memastikan form yang relevan terbuka saat terjadi error validasi
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.is-invalid')) {
                @if (session('show_reject_form'))
                    document.getElementById('reject_form').classList.remove('hidden');
                @else
                    document.getElementById('verify_form').classList.remove('hidden');
                @endif
            }
        });

        function toggleForm(formId) {
            const verifyForm = document.getElementById('verify_form');
            const rejectForm = document.getElementById('reject_form');

            if (formId === 'verify_form') {
                verifyForm.classList.toggle('hidden');
                rejectForm.classList.add('hidden');
            } else if (formId === 'reject_form') {
                rejectForm.classList.toggle('hidden');
                verifyForm.classList.add('hidden');
            }
        }
    </script>
    @endpush

    <div class="mb-4">
        <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-emerald-600">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pembayaran
        </a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-xl grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Detail Peserta & Pembayaran --}}
        <div class="lg:col-span-1 space-y-8">

            {{-- Status Pembayaran --}}
            <div>
                <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                    <i class="fas fa-signal text-emerald-600"></i> Status Verifikasi
                </h3>
                @php
                    $status = $pembayaran->status;
                    $statusClass = [
                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                        'verified' => 'bg-green-100 text-green-800 border-green-300',
                        'rejected' => 'bg-red-100 text-red-800 border-red-300',
                    ][$status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                    
                    $statusIcon = [
                        'pending' => 'fas fa-hourglass-half',
                        'verified' => 'fas fa-check-circle',
                        'rejected' => 'fas fa-times-circle',
                    ][$status] ?? 'fas fa-question-circle';
                @endphp
                <span class="px-3 py-1 inline-flex text-lg leading-6 font-bold rounded-full border {{ $statusClass }}">
                    <i class="{{ $statusIcon }} mr-2"></i> {{ ucfirst($status) }}
                </span>
                
                @if ($pembayaran->catatan_admin)
                    <div class="mt-3 p-3 text-sm rounded-lg {{ $status == 'rejected' ? 'bg-red-50 text-red-700' : 'bg-gray-50 text-gray-700' }}">
                        <strong class="font-semibold">Catatan Admin:</strong> 
                        {{ $pembayaran->catatan_admin }}
                    </div>
                @endif
            </div>

            <div class="border-t pt-6">
                <h3 class="text-xl font-bold mb-4 text-emerald-600 flex items-center gap-2">
                    <i class="fas fa-money-check-alt"></i> Detail Pembayaran
                </h3>
                <div class="bg-emerald-50/70 border border-emerald-200 rounded-lg p-4 space-y-3">
                    
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase flex items-center">
                            <i class="fas fa-tag mr-2"></i> Kategori Dipilih
                        </dt>
                        <dd class="text-lg font-bold text-gray-900">
                            @switch($pembayaran->kategori_pembayaran)
                                @case('asasi') Anggota ASASI @break
                                @case('umum') Umum @break
                                @case('mahasiswa') Mahasiswa @break
                                @case('non-presenter') Non Presenter @break
                                @default {{ ucfirst($pembayaran->kategori_pembayaran) }}
                            @endswitch
                        </dd>
                    </div>
                    
                    <div class="pt-2 border-t border-emerald-200">
                        <dt class="text-xs font-semibold text-gray-500 uppercase">Nominal Seharusnya</dt>
                        <dd class="text-3xl font-extrabold text-emerald-700">
                            Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                        </dd>
                    </div>

                    @if ($pembayaran->kategori_pembayaran == 'asasi' && $pembayaran->nomor_anggota_asasi)
                        <div class="pt-2 border-t border-red-200">
                            <dt class="text-xs font-semibold text-red-500 uppercase flex items-center">
                                <i class="fas fa-id-card mr-2"></i> Nomor Anggota ASASI
                            </dt>
                            <dd class="text-lg font-bold text-red-700 bg-red-100 px-2 py-1 rounded">
                                {{ $pembayaran->nomor_anggota_asasi }}
                            </dd>
                            <p class="text-xs text-red-600 mt-1 font-semibold">
                                *Wajib cek validitas nomor ini secara manual.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="border-t pt-6">
                <h3 class="text-xl font-bold mb-4 text-emerald-600 flex items-center gap-2">
                    <i class="fas fa-user-check"></i> Data Peserta
                </h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between items-start border-b border-dashed pb-2"><dt class="font-medium text-gray-500 w-1/3">Nama:</dt><dd class="text-gray-900 font-semibold w-2/3 text-right">{{ $pembayaran->user->nama_lengkap }}</dd></div>
                    <div class="flex justify-between items-start border-b border-dashed pb-2"><dt class="font-medium text-gray-500 w-1/3">Email:</dt><dd class="text-gray-900 w-2/3 text-right">{{ $pembayaran->user->email }}</dd></div>
                    <div class="flex justify-between items-start border-b border-dashed pb-2"><dt class="font-medium text-gray-500 w-1/3">Tgl Upload:</dt><dd class="text-gray-900 w-2/3 text-right">{{ $pembayaran->created_at->format('d M Y H:i') }} WIB</dd></div>
                    <div class="flex justify-between items-start"><dt class="font-medium text-gray-500 w-1/3">Role Akun:</dt><dd class="text-gray-900 w-2/3 text-right">{{ ucfirst($pembayaran->user->role) }}</dd></div>
                </dl>
            </div>
        </div>

        {{-- Kolom Kanan: Bukti Pembayaran & Action --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Blok Bukti Pembayaran --}}
            <div class="p-4 border border-gray-200 rounded-lg shadow-inner bg-gray-50">
                <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-image text-gray-600"></i> Bukti Pembayaran
                </h3>
                
                <div class="text-center">
                    @php
                        $filePath = $pembayaran->bukti_path;
                        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                        // PERBAIKAN: Gunakan route terproteksi
                        $fileRoute = route('admin.payments.view-bukti', $pembayaran);
                    @endphp
                    
                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                        {{-- Untuk gambar, gunakan route terproteksi sebagai sumber gambar --}}
                        <a href="{{ $fileRoute }}" target="_blank">
                            <img src="{{ $fileRoute }}" alt="Bukti Pembayaran" class="max-w-full h-auto mx-auto rounded-lg shadow-md mb-3 border border-gray-300" style="max-height: 500px; width: auto;">
                        </a>
                    @elseif (in_array($extension, ['pdf']))
                        <div class="my-5 p-6 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-file-pdf text-8xl text-red-600 mb-3"></i>
                            <p class="text-lg font-semibold text-gray-700">File Bukti: PDF</p>
                            <p class="text-gray-500">Klik tombol di bawah untuk melihat/mengunduh.</p>
                        </div>
                    @else
                        <div class="my-5 p-6 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-exclamation-triangle text-6xl text-yellow-500 mb-3"></i>
                            <p class="text-red-500 font-semibold">Format file tidak dikenali.</p>
                        </div>
                    @endif

                    {{-- PERBAIKAN LINK UTAMA: Selalu gunakan route terproteksi --}}
                    <a href="{{ $fileRoute }}" target="_blank" class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold mt-2 inline-block">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka Bukti di Tab Baru
                    </a>
                </div>
            </div>

            {{-- Blok Action --}}
            <div class="pt-4 border-t border-gray-200">
                @if ($pembayaran->status != 'verified')
                    <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                        <i class="fas fa-cogs"></i> Action Verifikasi
                    </h3>
                    <p class="text-sm text-gray-600 mb-4 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        Periksa kesesuaian antara <strong class="text-emerald-700">Nominal Seharusnya</strong> dengan <strong class="text-emerald-700">Bukti Transfer</strong>. 
                        @if($pembayaran->kategori_pembayaran == 'asasi')
                        <br>Periksa juga validitas <strong class="text-red-600">Nomor Anggota ASASI</strong> yang dilampirkan.
                        @endif
                    </p>

                    <div class="flex space-x-4">
                        {{-- TOMBOL VERIFIKASI --}}
                        <button onclick="toggleForm('verify_form')" 
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md">
                            <i class="fas fa-check-circle mr-1"></i> Verifikasi
                        </button>
                        
                        {{-- TOMBOL TOLAK --}}
                        <button onclick="toggleForm('reject_form')" 
                                class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition duration-150 shadow-md">
                            <i class="fas fa-times-circle mr-1"></i> Tolak
                        </button>
                    </div>
                    
                    
                    {{-- FORM VERIFIKASI (Hijau) --}}
                    @php $showVerifyForm = $errors->any() && !session('show_reject_form'); @endphp
                    <div id="verify_form" class="mt-4 p-5 bg-green-50 border border-green-300 rounded-xl shadow-lg {{ $showVerifyForm ? 'block' : 'hidden' }}">
                        <form action="{{ route('admin.payments.verify', $pembayaran->id) }}" method="POST">
                            @csrf
                            <label for="catatan_admin_verify" class="block text-sm font-medium text-green-800 mb-2">Catatan Verifikasi (Opsional)</label>
                            <textarea name="catatan_admin" id="catatan_admin_verify" rows="3"
                                class="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 @error('catatan_admin') border-red-500 is-invalid @enderror"
                                placeholder="Contoh: Pembayaran sudah sesuai dan valid. Peserta resmi terdaftar.">{{ old('catatan_admin', 'Pembayaran telah dikonfirmasi.') }}</textarea>
                            @error('catatan_admin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            
                            <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                                <i class="fas fa-thumbs-up mr-1"></i> Konfirmasi Verifikasi
                            </button>
                        </form>
                    </div>

                    {{-- Form Penolakan Detail (Wajib isi catatan) --}}
                    @php $showRejectForm = $errors->any() && session('show_reject_form'); @endphp
                    <div id="reject_form" class="mt-4 p-5 bg-red-50 border border-red-300 rounded-xl shadow-lg {{ $showRejectForm ? 'block' : 'hidden' }}">
                        <form action="{{ route('admin.payments.reject', $pembayaran->id) }}" method="POST">
                            @csrf
                            <label for="catatan_admin_reject" class="block text-sm font-medium text-red-800 mb-2">Catatan Penolakan (Wajib)</label>
                            <textarea name="catatan_admin" id="catatan_admin_reject" rows="3" required
                                class="w-full border-red-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('catatan_admin') border-red-500 is-invalid @enderror"
                                placeholder="Contoh: Bukti buram, mohon upload ulang bukti transfer yang jelas.">{{ old('catatan_admin') }}</textarea>
                            @error('catatan_admin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            <button type="submit" class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                                <i class="fas fa-trash-alt mr-1"></i> Konfirmasi Tolak & Kirim Catatan
                            </button>
                        </form>
                    </div>

                @else
                    {{-- Jika status sudah verified --}}
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl font-bold flex items-center shadow-md">
                        <i class="fas fa-check-double mr-3 text-2xl"></i> Pembayaran ini telah diverifikasi pada {{ $pembayaran->updated_at->format('d M Y H:i') }}.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection