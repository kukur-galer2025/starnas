@extends('peserta.layouts.main')

@section('title', 'Upload Abstrak')

@section('content')
    @php
        // Menggunakan variabel $abstrak yang dikirim dari controller
        $isVerified = $abstrak && $abstrak->status_abstrak == 'diterima';
        $isUploaded = $abstrak && $abstrak->file_abstrak_path;
        $status = $isUploaded ? $abstrak->status_abstrak : 'belum_upload';

        $statusData = [
            'pending' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Menunggu Review', 'icon' => 'fas fa-hourglass-half'],
            'diterima' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Diterima', 'icon' => 'fas fa-check-circle'],
            'ditolak' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Ditolak', 'icon' => 'fas fa-times-circle'],
            'belum_upload' => ['class' => 'bg-gray-100 text-gray-500', 'text' => 'Belum Ada', 'icon' => 'fas fa-upload'],
        ];
        $currentStatus = $statusData[$status];
    @endphp

    {{-- GRID KONTEN 2/3 DAN 1/3 --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI: FORM / STATUS AKHIR --}}
        <div class="xl:col-span-2"> 
            
            @if ($isVerified)
                {{-- TAMPILAN STATUS DITERIMA --}}
                <div class="rounded-2xl border border-green-200 bg-green-50 overflow-hidden p-8 text-center">
                    <i class="fas fa-check-circle text-green-500 text-5xl mb-4"></i>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Abstrak Anda Telah DITERIMA!</h2>
                    <p class="text-gray-600 mb-4">
                        Verifikasi berhasil pada {{ $abstrak->updated_at->format('d M Y') }}. Anda tidak perlu mengunggah ulang file abstrak Anda.
                    </p>
                    @if($abstrak->catatan_reviewer_abstrak)
                        <div class="bg-white border border-green-200 p-4 rounded-lg text-sm text-green-700 mx-auto max-w-sm">
                            <strong>Catatan Reviewer:</strong> {{ $abstrak->catatan_reviewer_abstrak }}
                        </div>
                    @endif
                </div>
            @else
                {{-- TAMPILAN FORM --}}
                <div class="rounded-2xl border border-gray-100 overflow-hidden shadow-inner bg-white">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-upload text-primary mr-2"></i>
                            Form Upload Abstrak
                        </h2>
                    </div>

                    <div class="p-6">
                        @if(session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        @if($status == 'ditolak')
                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                                <strong class="font-semibold">Abstrak Ditolak.</strong> Silakan perbaiki dan unggah ulang.
                                @if($abstrak->catatan_reviewer_abstrak)
                                    <p class="text-sm mt-1">Catatan: {{ $abstrak->catatan_reviewer_abstrak }}</p>
                                @endif
                            </div>
                        @endif

                        <form action="{{ route('peserta.abstrak.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label for="judul_abstrak" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Abstrak <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                        id="judul_abstrak" 
                                        name="judul_abstrak"
                                        value="{{ old('judul_abstrak', $abstrak->judul_abstrak ?? '') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition-colors duration-300 @error('judul_abstrak') border-red-500 @enderror"
                                        placeholder="Masukkan judul abstrak penelitian Anda" 
                                        required
                                        maxlength="255">
                                @error('judul_abstrak')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1 char-counter">0/255 karakter</p>
                            </div>

                            <div class="mb-6">
                                <label for="abstrak_file" class="block text-sm font-medium text-gray-700 mb-2">
                                    File Abstrak <span class="text-red-500">*</span>
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary transition-colors duration-300">
                                    <input type="file" 
                                            id="abstrak_file" 
                                            name="abstrak_file" 
                                            class="hidden"
                                            accept=".doc,.docx,.pdf" 
                                            {{ $isUploaded ? '' : 'required' }}>
                                    <div id="file-upload-area" class="cursor-pointer {{ $isUploaded ? 'hidden' : 'block' }}">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-gray-600 mb-1">
                                            <span class="text-primary font-semibold">Klik untuk upload</span> atau drag and drop
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Format: DOC, DOCX, PDF (Maksimal: 10MB)
                                        </p>
                                    </div>
                                    <div id="file-info" class="hidden mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center min-w-0 flex-1">
                                                <i class="fas fa-file text-emerald-600 mr-3 flex-shrink-0"></i>
                                                <div class="min-w-0 flex-1">
                                                    <p id="file-name" class="font-semibold text-emerald-950 truncate"></p>
                                                    <p id="file-size" class="text-sm text-emerald-800"></p>
                                                </div>
                                            </div>
                                            <button type="button" id="remove-file" class="text-red-500 hover:text-red-700 flex-shrink-0 ml-2">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('abstrak_file')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                    @if($isUploaded)
                                        <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center min-w-0 flex-1">
                                                    <i class="fas fa-file text-green-600 mr-3 flex-shrink-0"></i>
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-sm font-medium text-green-800 truncate">
                                                            File saat ini: {{ $abstrak->file_abstrak_original_name }}
                                                        </p>
                                                        <p class="text-xs text-green-600">
                                                            Diunggah: {{ $abstrak->updated_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-emerald-600/20 flex items-center justify-center">
                                <i class="fas fa-upload mr-2"></i>
                                {{ $isUploaded ? 'Update Abstrak' : 'Upload Abstrak' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        {{-- KOLOM KANAN: Status & Informasi --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-primary mr-2"></i>
                    Status Abstrak
                </h3>
                <div class="text-center py-4">
                    <i class="{{ $currentStatus['icon'] }} text-4xl {{ $status == 'pending' ? 'text-yellow-500' : ($status == 'diterima' ? 'text-green-500' : ($status == 'ditolak' ? 'text-red-500' : 'text-gray-400')) }} mb-3"></i>
                    <p class="text-lg font-bold {{ $currentStatus['class'] }} inline-block px-3 py-1 rounded-full">
                        {{ $currentStatus['text'] }}
                    </p>
                    
                    @if ($isUploaded && $status == 'pending')
                        <p class="text-sm text-gray-600 mt-2">Abstrak Anda sedang dalam antrian review.</p>
                    @elseif ($isUploaded && $status == 'ditolak')
                        <p class="text-sm text-red-600 mt-2 font-semibold">Harap segera perbaiki dan unggah ulang!</p>
                    @elseif ($isVerified)
                         <p class="text-sm text-green-600 mt-2 font-semibold">Anda telah lolos verifikasi abstrak.</p>
                    @elseif (!$isUploaded)
                        <p class="text-sm text-gray-600 mt-2">Silakan unggah abstrak Anda melalui form di samping.</p>
                    @endif

                    @if($isUploaded)
                        <div class="mt-4 p-3 bg-gray-50 border border-gray-200 rounded-lg text-left">
                            <p class="text-xs font-medium text-gray-600">File Terakhir:</p>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-sm text-gray-700 truncate min-w-0 flex-1">
                                    <i class="fas fa-file mr-1"></i> {{ $abstrak->file_abstrak_original_name }}
                                </span>
                                <a href="{{ route('peserta.abstrak.download') }}" title="Unduh" class="text-primary hover:text-emerald-700 flex-shrink-0 ml-2">
                                    <i class="fas fa-download"></i>
                                </a>
                                @if(!$isVerified)
                                <form action="{{ route('peserta.abstrak.delete') }}" method="POST" class="ml-2" onsubmit="return confirm('Yakin ingin menghapus abstrak ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Hapus Abstrak">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 via-teal-50/50 to-emerald-100/40 border border-emerald-200 rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-emerald-950 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-accent mr-2"></i>
                    Panduan Upload
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Format file: DOC, DOCX, atau PDF</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Ukuran maksimal: 10MB</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Pastikan judul sesuai dengan penelitian</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Abstrak akan direview dalam 3-7 hari kerja</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // File Upload Handling
        const fileInput = document.getElementById('abstrak_file');
        const uploadArea = document.querySelector('.border-dashed');
        const fileUploadArea = document.getElementById('file-upload-area');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeFileBtn = document.getElementById('remove-file');
        const judulInput = document.getElementById('judul_abstrak');
        const charCounter = document.querySelector('.char-counter');

        const isVerified = {{ $isVerified ? 'true' : 'false' }};
        const isCurrentlyUploaded = {{ $isUploaded ? 'true' : 'false' }};

        if (!isVerified) { 
            if (fileUploadArea && fileInput) {
                fileUploadArea.addEventListener('click', () => fileInput.click());
                fileInput.addEventListener('change', (e) => {
                    if (e.target.files.length) {
                        handleFileSelect(e.target.files[0]);
                    }
                });

                if (uploadArea) {
                    uploadArea.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        uploadArea.classList.add('border-primary', 'bg-emerald-50');
                    });
                    
                    uploadArea.addEventListener('dragleave', () => {
                        uploadArea.classList.remove('border-primary', 'bg-emerald-50');
                    });
                    
                    uploadArea.addEventListener('drop', (e) => {
                        e.preventDefault();
                        uploadArea.classList.remove('border-primary', 'bg-emerald-50');
                        if (e.dataTransfer.files.length) {
                            fileInput.files = e.dataTransfer.files;
                            handleFileSelect(e.dataTransfer.files[0]);
                        }
                    });
                }
            }

            if (removeFileBtn) {
                removeFileBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    fileInput.value = '';
                    fileInfo.classList.add('hidden');
                    fileUploadArea.classList.remove('hidden');
                });
            }

            function handleFileSelect(file) {
                if (file) {
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    fileInfo.classList.remove('hidden');
                    fileUploadArea.classList.add('hidden');
                }
            }
        }
        
        // Character counter logic
        if (judulInput && charCounter) {
            judulInput.addEventListener('input', function() {
                const maxLength = 255;
                const currentLength = this.value.length;
                charCounter.textContent = `${currentLength}/${maxLength} karakter`;
                
                if (currentLength > maxLength * 0.8) {
                    charCounter.classList.add('text-orange-500');
                    charCounter.classList.remove('text-gray-500');
                } else {
                    charCounter.classList.remove('text-orange-500');
                    charCounter.classList.add('text-gray-500');
                }
            });
            judulInput.dispatchEvent(new Event('input'));
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
    @endpush
@endsection