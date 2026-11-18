@extends('peserta.layouts.main')

@section('title', 'Upload Abstrak')

@section('content')
    {{-- GRID KONTEN 2/3 DAN 1/3 --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        {{-- KOLOM KIRI: Daftar abstrak + Form upload --}}
        <div class="xl:col-span-2 space-y-6">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-2 text-green-500"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- HEADER --}}
            <div class="flex items-center mb-2">
                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-file-alt text-primary text-lg"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Manajemen Abstrak</h1>
                    <p class="text-gray-500 text-sm mt-1">Anda dapat mengunggah hingga <strong>{{ $batasAbstrak }} abstrak</strong> ({{ $abstraks->count() }}/{{ $batasAbstrak }} terpakai)</p>
                </div>
            </div>

            {{-- DAFTAR ABSTRAK --}}
            @if($abstraks->isEmpty())
                <div class="bg-teal-50 border border-teal-200 rounded-2xl p-8 text-center">
                    <i class="fas fa-inbox text-teal-400 text-4xl mb-3"></i>
                    <p class="text-teal-800 font-medium">Belum ada abstrak yang diunggah.</p>
                    <p class="text-teal-600 text-sm mt-1">Gunakan form di bawah untuk mengunggah abstrak pertama Anda.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($abstraks as $index => $abs)
                        @php
                            $st = $abs->status_abstrak;
                            $stConfig = [
                                'pending'  => ['badge' => 'bg-yellow-100 text-yellow-800', 'icon' => 'fas fa-hourglass-half text-yellow-500', 'label' => 'Menunggu Review', 'border' => 'border-yellow-300'],
                                'diterima' => ['badge' => 'bg-green-100 text-green-800',  'icon' => 'fas fa-check-circle text-green-500',   'label' => 'Diterima',        'border' => 'border-green-400'],
                                'ditolak'  => ['badge' => 'bg-red-100 text-red-800',     'icon' => 'fas fa-times-circle text-red-500',    'label' => 'Ditolak',         'border' => 'border-red-400'],
                            ][$st] ?? ['badge' => 'bg-gray-100 text-gray-700', 'icon' => 'fas fa-question text-gray-400', 'label' => $st, 'border' => 'border-gray-300'];
                        @endphp
                        <div class="bg-white rounded-2xl shadow border {{ $stConfig['border'] }} border-l-4 p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-4 min-w-0 flex-1">
                                    <div class="flex-shrink-0 mt-1">
                                        <i class="{{ $stConfig['icon'] }} text-2xl"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap mb-1">
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Abstrak #{{ $index + 1 }}</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $stConfig['badge'] }}">{{ $stConfig['label'] }}</span>
                                        </div>
                                        <p class="font-semibold text-gray-900 leading-snug mb-1">{{ $abs->judul_abstrak }}</p>
                                        <p class="text-xs text-gray-500">
                                            <i class="fas fa-file mr-1"></i>{{ $abs->file_abstrak_original_name }}
                                            &bull; Diunggah {{ $abs->created_at->format('d M Y, H:i') }}
                                        </p>
                                        @if($abs->catatan_reviewer_abstrak)
                                            <div class="mt-2 p-2.5 rounded-lg {{ $st === 'ditolak' ? 'bg-red-50 border border-red-200' : 'bg-gray-50 border border-gray-200' }}">
                                                <p class="text-xs font-semibold text-gray-600 mb-0.5">Catatan Reviewer:</p>
                                                <p class="text-sm {{ $st === 'ditolak' ? 'text-red-700' : 'text-gray-800' }} italic">{{ $abs->catatan_reviewer_abstrak }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- Tombol aksi --}}
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <a href="{{ route('peserta.abstrak.download', $abs->id) }}"
                                       title="Unduh file abstrak"
                                       class="inline-flex items-center justify-center px-3 py-2 bg-primary/10 hover:bg-primary/20 text-primary font-semibold rounded-xl text-xs transition-colors duration-200">
                                        <i class="fas fa-download mr-1.5"></i> Unduh
                                    </a>
                                    @if($st !== 'diterima')
                                        <form action="{{ route('peserta.abstrak.delete', $abs->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus abstrak ini? Tindakan tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-full px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold rounded-xl text-xs transition-colors duration-200">
                                                <i class="fas fa-trash-alt mr-1.5"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- FORM UPLOAD BARU --}}
            @if($sudahMaksimal)
                <div class="bg-orange-50 border border-orange-200 rounded-2xl p-6 text-center">
                    <i class="fas fa-exclamation-triangle text-orange-400 text-3xl mb-3"></i>
                    <h3 class="font-bold text-orange-800 text-lg mb-1">Batas Maksimal Tercapai</h3>
                    <p class="text-orange-700 text-sm">Anda telah mengunggah <strong>{{ $batasAbstrak }} abstrak</strong> (batas maksimal). Hubungi panitia jika Anda memerlukan bantuan.</p>
                </div>
            @else
                <div class="rounded-2xl border border-gray-100 overflow-hidden shadow-inner bg-white">
                    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-plus-circle text-primary mr-2"></i>
                            Upload Abstrak Baru
                        </h2>
                    </div>

                    <div class="p-6">
                        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg mb-6 text-sm">
                            <p class="mb-2"><i class="fas fa-info-circle mr-1"></i> Upload abstrak terlebih dahulu. Pembayaran kategori pemakalah baru dapat dilakukan <strong>setelah abstrak diterima</strong>. Peserta tanpa presentasi (Non Presenter) tidak wajib upload abstrak.</p>
                            <a href="/storage/Template_Abstrak_STARNAS_ASASI_2026.docx" download="Template Abstrak STARNAS ASASI 2026.docx"
                               class="inline-flex items-center font-semibold text-amber-900 hover:underline">
                                <i class="fas fa-download mr-2"></i> Download Template Abstrak
                            </a>
                        </div>

                        <form action="{{ route('peserta.abstrak.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label for="judul_abstrak" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Abstrak <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                        id="judul_abstrak"
                                        name="judul_abstrak"
                                        value="{{ old('judul_abstrak') }}"
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
                                            required>
                                    <div id="file-upload-area" class="cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-gray-600 mb-1">
                                            <span class="text-primary font-semibold">Klik untuk upload</span> atau drag and drop
                                        </p>
                                        <p class="text-sm text-gray-500">Format: DOC, DOCX, PDF (Maksimal: 10MB)</p>
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
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-[1.02] shadow-lg shadow-emerald-600/20 flex items-center justify-center">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Abstrak
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        {{-- KOLOM KANAN: Info & Panduan --}}
        <div class="space-y-6">
            {{-- Progress Abstrak --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-tasks text-primary mr-2"></i>
                    Progress Abstrak
                </h3>
                <div class="text-center py-2">
                    <div class="text-4xl font-bold text-primary mb-1">{{ $abstraks->count() }}<span class="text-gray-400 text-2xl">/{{ $batasAbstrak }}</span></div>
                    <p class="text-sm text-gray-500">abstrak diunggah</p>
                    <div class="mt-4 w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-3 rounded-full transition-all duration-500"
                             style="width: {{ ($abstraks->count() / $batasAbstrak) * 100 }}%"></div>
                    </div>
                </div>

                @if($abstraks->isNotEmpty())
                    <div class="mt-4 space-y-2">
                        @foreach($abstraks as $i => $abs)
                            @php
                                $dotColor = ['pending' => 'bg-yellow-400', 'diterima' => 'bg-green-500', 'ditolak' => 'bg-red-500'][$abs->status_abstrak] ?? 'bg-gray-400';
                            @endphp
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="w-2 h-2 rounded-full {{ $dotColor }} flex-shrink-0"></span>
                                <span class="truncate flex-1">Abstrak #{{ $i + 1 }}: {{ Str::limit($abs->judul_abstrak, 35) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Panduan --}}
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
                        <span class="text-sm text-emerald-900">Ukuran maksimal: 10MB per file</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Maks. <strong>{{ $batasAbstrak }} abstrak</strong> per akun</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Pastikan judul sesuai dengan penelitian</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-emerald-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Abstrak akan direview dalam 3-7 hari kerja</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-info-circle text-teal-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm text-emerald-900">Abstrak yang sudah <strong>diterima</strong> tidak dapat dihapus</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const fileInput = document.getElementById('abstrak_file');
        const uploadArea = document.querySelector('.border-dashed');
        const fileUploadArea = document.getElementById('file-upload-area');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeFileBtn = document.getElementById('remove-file');
        const judulInput = document.getElementById('judul_abstrak');
        const charCounter = document.querySelector('.char-counter');

        if (fileUploadArea && fileInput) {
            fileUploadArea.addEventListener('click', () => fileInput.click());
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length) handleFileSelect(e.target.files[0]);
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

        if (judulInput && charCounter) {
            judulInput.addEventListener('input', function() {
                const maxLength = 255;
                const currentLength = this.value.length;
                charCounter.textContent = `${currentLength}/${maxLength} karakter`;
                charCounter.classList.toggle('text-orange-500', currentLength > maxLength * 0.8);
                charCounter.classList.toggle('text-gray-500', currentLength <= maxLength * 0.8);
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
