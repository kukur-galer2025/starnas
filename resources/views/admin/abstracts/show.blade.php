@extends('admin.layouts.app')

{{-- Perbaikan: Menggunakan $abstrak->user untuk nama peserta --}}
@section('title', 'Detail Abstrak - ' . $abstrak->user->nama_lengkap)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900">Detail Abstrak</h1>
                    <p class="text-gray-600 mt-1">Review dan verifikasi abstrak peserta</p>
                </div>
                <a href="{{ route('admin.abstracts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">
            <div class="xl:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-circle text-primary text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Peserta</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- PERBAIKAN: Menggunakan $abstrak->user --}}
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</p>
                            <p class="text-sm text-gray-900 font-medium">{{ $abstrak->user->nama_lengkap }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Email</p>
                            <p class="text-sm text-gray-900 break-all">{{ $abstrak->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Institusi</p>
                            <p class="text-sm text-gray-900">{{ $abstrak->user->institusi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">No. Handphone</p>
                            <p class="text-sm text-gray-900">{{ $abstrak->user->nomor_handphone ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-emerald-500 bg-opacity-10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-emerald-600 text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Status Abstrak</h3>
                    </div>

                    <div class="space-y-4">
                        {{-- PERBAIKAN: Menggunakan $abstrak --}}
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Status Verifikasi</p>
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                     @if($abstrak->status_abstrak == 'diterima') bg-green-100 text-green-800
                                     @elseif($abstrak->status_abstrak == 'ditolak') bg-red-100 text-red-800
                                     @else bg-yellow-100 text-yellow-800 @endif">
                                @if($abstrak->status_abstrak == 'diterima') Diterima
                                @elseif($abstrak->status_abstrak == 'ditolak') Ditolak
                                @else Menunggu Review
                                @endif
                            </span>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">File Abstrak</p>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center min-w-0 flex-1">
                                        <i class="fas fa-file text-gray-400 mr-2 flex-shrink-0"></i>
                                        <span class="text-sm text-gray-700 truncate">
                                            {{ $abstrak->file_abstrak_original_name }}
                                        </span>
                                    </div>
                                    <a href="{{ route('admin.abstracts.download', $abstrak->id) }}"
                                        class="text-primary hover:text-emerald-700 transition-colors duration-200 flex-shrink-0 ml-2"
                                        title="Download File">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if($abstrak->catatan_reviewer_abstrak)
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Catatan Reviewer</p>
                                <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                                    <p class="text-sm text-amber-800 leading-relaxed">
                                        {{ $abstrak->catatan_reviewer_abstrak }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="xl:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-teal-500 bg-opacity-10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-alt text-teal-600 text-lg"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Detail Abstrak</h3>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Judul Abstrak</label>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <p class="text-gray-900 font-medium leading-relaxed break-words">{{ $abstrak->judul_abstrak }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">File Abstrak</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center bg-gray-50">
                            <div class="max-w-md mx-auto">
                                <i class="fas fa-file-pdf text-5xl text-red-500 mb-4"></i>
                                <p class="text-gray-700 font-medium mb-2 truncate">{{ $abstrak->file_abstrak_original_name }}</p>
                                <p class="text-sm text-gray-500 mb-6">Klik tombol di bawah untuk mengunduh file lengkap</p>
                                
                                {{-- PERBAIKAN STYLING TOMBOL DOWNLOAD (Mengatasi masalah tidak terlihat/styling) --}}
                                <a href="{{ route('admin.abstracts.download', $abstrak->id) }}"
                                    class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-lg font-medium hover:bg-emerald-700 transition-colors duration-200 shadow-md shadow-emerald-600/20">
                                    <i class="fas fa-download mr-2"></i> Download File
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($abstrak->status_abstrak == 'pending')
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-8 h-8 bg-green-500 bg-opacity-10 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900">Verifikasi Abstrak</h4>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="bg-green-50 border border-green-200 rounded-xl p-5">
                                    <form action="{{ route('admin.abstracts.verify', $abstrak->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="catatan_diterima" class="block text-sm font-medium text-green-800 mb-2">
                                                <i class="fas fa-comment mr-1"></i> Catatan (Opsional)
                                            </label>
                                            <textarea name="catatan_reviewer_abstrak" id="catatan_diterima" rows="3"
                                                placeholder="Berikan catatan positif atau saran untuk peserta..."
                                                class="w-full px-3 py-2 border border-green-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-sm">{{ old('catatan_reviewer_abstrak') }}</textarea>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition-colors duration-200 flex items-center justify-center shadow-sm">
                                            <i class="fas fa-check-circle mr-2"></i> Terima Abstrak
                                        </button>
                                    </form>
                                </div>

                                <div class="bg-red-50 border border-red-200 rounded-xl p-5">
                                    <form action="{{ route('admin.abstracts.reject', $abstrak->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="catatan_ditolak" class="block text-sm font-medium text-red-800 mb-2">
                                                <i class="fas fa-exclamation-circle mr-1"></i> Alasan Penolakan *
                                            </label>
                                            <textarea name="catatan_reviewer_abstrak" id="catatan_ditolak" rows="3" required
                                                placeholder="Jelaskan alasan penolakan secara jelas dan konstruktif..."
                                                class="w-full px-3 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white text-sm">{{ old('catatan_reviewer_abstrak') }}</textarea>
                                            @error('catatan_reviewer_abstrak')
                                                <p class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition-colors duration-200 flex items-center justify-center shadow-sm">
                                            <i class="fas fa-times-circle mr-2"></i> Tolak Abstrak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tampilan setelah diverifikasi/ditolak --}}
                        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 text-center">
                            <i class="fas fa-check-circle text-emerald-600 text-3xl mb-3"></i>
                            <h4 class="text-lg font-semibold text-emerald-900 mb-2">Abstrak Telah Diverifikasi</h4>
                            <p class="text-emerald-800 text-sm">
                                Status:
                                <span class="font-semibold">
                                    @if($abstrak->status_abstrak == 'diterima') Diterima
                                    @elseif($abstrak->status_abstrak == 'ditolak') Ditolak
                                    @endif
                                </span>
                            </p>
                            @if($abstrak->catatan_reviewer_abstrak)
                                <div class="mt-4 p-3 bg-white rounded-lg border border-emerald-100">
                                    <p class="text-sm text-gray-700 text-left">{{ $abstrak->catatan_reviewer_abstrak }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .break-words {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Smooth transitions for better UX */
        .transition-colors {
            transition: color 0.2s ease, background-color 0.2s ease, border-color 0.2s ease;
        }
    </style>
@endpush