@extends('peserta.layouts.main')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 p-4 md:p-6 rounded-2xl shadow-lg mb-6"
            role="alert">
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle text-green-500 text-xl flex-shrink-0"></i>
                <div>
                    <p class="font-semibold">Berhasil!</p>
                    <p class="text-sm mt-1">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- VALIDATION ERRORS ALERT --}}
    @if($errors->any())
        <div class="bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 text-red-800 p-4 md:p-6 rounded-2xl shadow-lg mb-6"
            role="alert">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-circle text-red-500 text-xl flex-shrink-0"></i>
                <div>
                    <p class="font-semibold">Terjadi Kesalahan Validasi</p>
                    <ul class="list-disc list-inside text-sm mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- GENERIC ERROR ALERT --}}
    @if(session('error'))
        <div class="bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 text-red-800 p-4 md:p-6 rounded-2xl shadow-lg mb-6"
            role="alert">
            <div class="flex items-center space-x-3">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl flex-shrink-0"></i>
                <div>
                    <p class="font-semibold">Peringatan</p>
                    <p class="text-sm mt-1">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- MAIN CONTENT GRID: Kolom utama (2/3) dan Kolom sidebar (1/3) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KOLOM UTAMA (FORM & STATUS ALERT) --}}
        <div class="lg:col-span-2 space-y-6 order-2 lg:order-1">
            
            <div class="flex items-center mb-2">
                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                    <i class="fas fa-cloud-upload-alt text-primary text-lg"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Upload Bukti Transfer</h3>
                    <p class="text-gray-600 text-sm mt-1">Unggah bukti pembayaran untuk proses verifikasi</p>
                </div>
            </div>

            @php
                // Logika untuk menentukan apakah user boleh upload
                $canUpload = !$pembayaran || $pembayaran->status === 'rejected';
            @endphp

            {{-- ALERT: JIKA TIDAK BISA UPLOAD (PENDING/VERIFIED) --}}
            @if(!$canUpload)
                <div
                    class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-primary text-emerald-950 p-6 rounded-2xl shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-2xl text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-lg mb-2 text-emerald-900">Status Upload</h4>
                            @if($pembayaran->status == 'verified')
                                <p class="text-emerald-800 leading-relaxed">
                                    <strong class="text-emerald-600">Pembayaran Anda telah terverifikasi!</strong>
                                    Anda tidak perlu mengunggah bukti pembayaran lagi.
                                </p>
                            @else
                                <p class="text-emerald-800 leading-relaxed">
                                    <strong class="text-amber-600">Bukti pembayaran Anda sedang menunggu verifikasi.</strong>
                                    Harap tunggu keputusan dari admin.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                {{-- FORM UPLOAD --}}
                <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-gray-200">
                    <form id="form-bukti" action="{{ route('peserta.pembayaran.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="space-y-6">
                            {{-- Field: Kategori Pendaftaran --}}
                            <div>
                                <label for="kategori_pembayaran" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tags text-primary mr-2"></i>
                                    Pilih Kategori Pendaftaran <span class="text-red-500">*</span>
                                </label>
                                <select id="kategori_pembayaran" name="kategori_pembayaran" required
                                    class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-300">
                                    <option value="" selected disabled>-- Pilih Kategori & Tarif Pendaftaran --</option>
                                    <optgroup label="📍 KATEGORI ONSITE (OFFLINE DI YOGYAKARTA)">
                                        <option value="asasi_onsite" @disabled(!($bolehPemakalah ?? false))>Anggota ASASI (Pemakalah Onsite) — Rp 450.000</option>
                                        <option value="umum_onsite" @disabled(!($bolehPemakalah ?? false))>Umum (Pemakalah Onsite) — Rp 500.000</option>
                                        <option value="mahasiswa_onsite" @disabled(!($bolehPemakalah ?? false))>Mahasiswa (Pemakalah Onsite) — Rp 250.000</option>
                                    </optgroup>
                                    <optgroup label="💻 KATEGORI ONLINE (VIRTUAL ZOOM)">
                                        <option value="asasi_online" @disabled(!($bolehPemakalah ?? false))>Anggota ASASI (Pemakalah Online) — Rp 250.000</option>
                                        <option value="umum_online" @disabled(!($bolehPemakalah ?? false))>Umum (Pemakalah Online) — Rp 300.000</option>
                                        <option value="mahasiswa_online" @disabled(!($bolehPemakalah ?? false))>Mahasiswa (Pemakalah Online) — Rp 150.000</option>
                                        <option value="non-presenter">Non Presenter (Online) — Rp 100.000</option>
                                    </optgroup>
                                </select>
                                @if(!($bolehPemakalah ?? false))
                                    <p class="mt-2 text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Kategori pemakalah baru bisa dipilih setelah abstrak Anda <strong>diterima</strong>.
                                        <a href="{{ route('peserta.abstrak.upload') }}" class="underline font-semibold">Upload abstrak</a>.
                                        Jika hanya hadir tanpa presentasi, pilih <strong>Non Presenter</strong>.
                                    </p>
                                @endif
                            </div>

                            {{-- Display Harga (Javascript controlled) --}}
                            <div id="harga-display" class="hidden text-right p-3 bg-emerald-50 rounded-xl border border-emerald-200">
                                <p class="text-gray-600 text-sm">Biaya yang harus dibayar:</p>
                                <p id="harga-teks" class="text-3xl font-bold text-primary"></p>
                            </div>

                            {{-- Field: Nomor Anggota ASASI (Javascript controlled) --}}
                            {{-- Tampil jika memilih kategori yang mengandung "asasi" --}}
                            <div id="nomor-anggota-asasi" class="hidden">
                                <label for="nomor_anggota_asasi" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-id-card text-primary mr-2"></i>
                                    Nomor Anggota ASASI <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nomor_anggota_asasi" name="nomor_anggota_asasi"
                                    placeholder="Masukkan Nomor Anggota ASASI Anda"
                                    class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-300">
                                <p class="text-xs text-gray-500 mt-2">Nomor anggota akan diverifikasi oleh Admin.</p>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">
                        
                        {{-- Field: File Upload --}}
                        <div>
                            <label for="bukti_bayar" class="block text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-file-upload text-primary mr-2"></i>
                                Pilih File Bukti Pembayaran <span class="text-red-500">*</span>
                            </label>

                            <div class="flex items-center justify-center w-full">
                                <label for="bukti_bayar"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-300">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                        <p class="text-sm text-gray-500 font-medium">Klik untuk memilih file atau seret ke sini</p>
                                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, atau PDF (Maks. 10MB)</p>
                                    </div>
                                    <input id="bukti_bayar" name="bukti_bayar" type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf" />
                                </label>
                            </div>

                            {{-- File Name Display --}}
                            <div id="file-name" class="mt-3 p-3 bg-emerald-50 rounded-xl text-sm text-gray-700 border border-emerald-200 hidden">
                                <i class="fas fa-file mr-2 text-primary"></i>
                                File Terpilih: <span id="file-name-text" class="font-medium text-emerald-900"></span>
                            </div>
                            <p id="bukti-error" class="hidden mt-2 text-sm text-red-500"></p>

                            {{-- Alert: Bukti Ditolak --}}
                            @if($pembayaran && $pembayaran->status == 'rejected')
                                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-exclamation-triangle text-red-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <h5 class="font-semibold text-red-800 text-sm">Bukti Sebelumnya Ditolak</h5>
                                            <p class="text-red-700 text-xs mt-1">
                                                Catatan Admin:
                                                <strong>{{ $pembayaran->catatan_admin ?? 'Tidak ada catatan' }}</strong>
                                            </p>
                                            <p class="text-red-600 text-xs mt-2">Silakan unggah bukti pembayaran yang baru.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-3"></i>
                                Kirim Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            {{-- KONTAK BANTUAN --}}
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg order-3">
                <div class="flex flex-col sm:flex-row items-center justify-between">
                    <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-headset text-white text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Butuh Bantuan?</h4>
                            <p class="text-gray-600 text-sm">Hubungi admin untuk pertanyaan teknis</p>
                        </div>
                    </div>
                    {{-- Ganti link/nomor WhatsApp jika diperlukan --}}
                    <a href="https://wa.me/6285225519882?text=Halo%20Admin%20STARNAS%20ASASI%202026,%20saya%20butuh%20bantuan%20terkait%20pembayaran" target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                        <i class="fab fa-whatsapp text-lg mr-2"></i>
                        Chat Admin (085225519882)
                    </a>
                </div>
            </div>
        </div>

        {{-- KOLOM SIDEBAR (STATUS DAN TIPS) --}}
        <div class="lg:col-span-1 space-y-6 order-1 lg:order-2">
            
            {{-- STATUS CARD --}}
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 
                @if(!$pembayaran) border-red-500 
                @elseif($pembayaran->status == 'pending') border-orange-500 
                @elseif($pembayaran->status == 'verified') border-green-500 
                @else border-red-500 @endif">

                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-gray-800">Status Verifikasi</h4>
                    <i class="fas @if(!$pembayaran) fa-times-circle text-red-500 
                    @elseif($pembayaran->status == 'pending') fa-clock text-orange-500 
                    @elseif($pembayaran->status == 'verified') fa-check-circle text-green-500 
                    @else fa-times-circle text-red-500 @endif text-xl"></i>
                </div>

                @if(!$pembayaran)
                    <p class="text-2xl font-bold text-red-500 mb-3">Belum Ada Bukti</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-sm text-gray-600">Silakan unggah bukti transfer untuk memulai verifikasi</p>
                @elseif($pembayaran->status == 'pending')
                    <p class="text-2xl font-bold text-orange-500 mb-3">Menunggu Verifikasi</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 50%"></div>
                    </div>
                    <p class="text-sm text-gray-600">Bukti Anda sedang diperiksa oleh admin</p>
                @elseif($pembayaran->status == 'verified')
                    <p class="text-2xl font-bold text-green-500 mb-3">Terverifikasi</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                    <p class="text-sm text-gray-600">Pembayaran berhasil! Status Anda aktif</p>
                @else
                    <p class="text-2xl font-bold text-red-500 mb-3">Ditolak</p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 25%"></div>
                    </div>
                    <p class="text-sm text-gray-600">Bukti ditolak. Silakan upload ulang</p>
                @endif
            </div>

            {{-- REKENING TUJUAN TRANSFER --}}
            <div class="bg-gradient-to-br from-primary/5 to-teal-50/40 rounded-2xl shadow-lg p-5 border border-primary/20">
                <h4 class="font-bold text-gray-800 mb-3 flex items-center text-sm">
                    <i class="fas fa-university text-primary mr-2"></i>
                    Rekening Pembayaran
                </h4>
                <div class="space-y-2.5 text-xs">
                    <div class="p-3 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <span class="text-gray-500 block text-[11px] mb-0.5">Bank Tujuan:</span>
                        <strong class="text-gray-900 text-sm">Bank BSI</strong>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                        <div>
                            <span class="text-gray-500 block text-[11px] mb-0.5">Nomor Rekening:</span>
                            <strong class="text-primary text-base font-black font-mono tracking-wider">1912749480</strong>
                        </div>
                        <button type="button" 
                            onclick="copyToClipboard('1912749480', this)" 
                            class="px-2.5 py-1 bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold rounded-lg text-xs transition-all">
                            Salin
                        </button>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <span class="text-gray-500 block text-[11px] mb-0.5">Atas Nama:</span>
                        <strong class="text-gray-900 text-xs">Abdul Hadi Kadarusno</strong>
                    </div>
                    <a href="https://wa.me/628122729039?text=Halo%20Admin%20STARNAS%20ASASI%202026,%20saya%20sudah%20melakukan%20transfer%20ke%20rekening%20BSI%201912749480%20a.n.%20Abdul%20Hadi%20Kadarusno.%20Mohon%20untuk%20dikonfirmasi." 
                       target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs shadow transition-all">
                        <i class="fab fa-whatsapp text-sm"></i> Konfirmasi: +62 812-2729-039
                    </a>
                </div>
            </div>

            {{-- TIPS UPLOAD --}}
            <div class="bg-gradient-to-br from-emerald-50 via-teal-50/50 to-emerald-100/40 rounded-2xl shadow-lg p-5 border border-emerald-200">
                <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-accent mr-2"></i>
                    Tips Upload
                </h4>
                <ul class="text-sm text-gray-700 space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                        <span>Pastikan foto bukti transfer jelas terbaca</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                        <span>Format file: JPG, PNG, atau PDF</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                        <span>Ukuran maksimal 10 MB</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-1 text-xs flex-shrink-0"></i>
                        <span>Proses verifikasi 1-2 hari kerja</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // ==============================================
        // == SCRIPT BARU UNTUK KATEGORI DAN HARGA ==
        // ==============================================
        document.getElementById('kategori_pembayaran').addEventListener('change', function (e) {
            const kategori = e.target.value;
            const hargaDisplayDiv = document.getElementById('harga-display');
            const hargaTeks = document.getElementById('harga-teks');
            const noAnggotaDiv = document.getElementById('nomor-anggota-asasi');
            const noAnggotaInput = document.getElementById('nomor_anggota_asasi');

            // Harga sesuai poster: Onsite (O) dan Online (L)
            const harga = {
                // Pemakalah Onsite
                'asasi_onsite': 'Rp 450.000',
                'umum_onsite': 'Rp 500.000',
                'mahasiswa_onsite': 'Rp 250.000',
                // Pemakalah Online
                'asasi_online': 'Rp 250.000',
                'umum_online': 'Rp 300.000',
                'mahasiswa_online': 'Rp 150.000',
                // Non Presenter
                'non-presenter': 'Rp 100.000'
            };

            if (kategori in harga) {
                // 1. Tampilkan harga
                hargaTeks.textContent = harga[kategori];
                hargaDisplayDiv.classList.remove('hidden');

                // 2. Cek apakah Anggota ASASI (onsite atau online)
                if (kategori.includes('asasi')) {
                    noAnggotaDiv.classList.remove('hidden');
                    noAnggotaInput.setAttribute('required', 'required');
                } else {
                    noAnggotaDiv.classList.add('hidden');
                    noAnggotaInput.removeAttribute('required');
                    noAnggotaInput.value = '';
                }
            } else {
                // Sembunyikan jika memilih default ("-- Pilih Kategori --")
                hargaDisplayDiv.classList.add('hidden');
                noAnggotaDiv.classList.add('hidden');
                noAnggotaInput.removeAttribute('required');
            }
        });

        // ==============================================
        // == SCRIPT FILE NAME DAN DRAG/DROP ==
        // ==============================================

        const fileInput = document.getElementById('bukti_bayar');
        const dropArea = document.querySelector('label[for="bukti_bayar"]');
        
        // 💡 Perbaikan Bug: Hanya jalankan script ini jika elemen form ada
        if (fileInput && dropArea) { 

            // File name display
            const buktiError = document.getElementById('bukti-error');
            const tampilkanErrorBukti = function (pesan) {
                buktiError.textContent = pesan;
                buktiError.classList.toggle('hidden', !pesan);
            };

            // Input file disembunyikan, jadi validasi "wajib" bawaan browser tidak bisa
            // menampilkan pesan (form diam saja). Cek manual di sini.
            document.getElementById('form-bukti').addEventListener('submit', function (e) {
                if (!fileInput.files.length) {
                    e.preventDefault();
                    tampilkanErrorBukti('Silakan pilih file bukti pembayaran terlebih dahulu.');
                    dropArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });

            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                const fileName = file?.name;
                const fileNameDisplay = document.getElementById('file-name');
                const fileNameText = document.getElementById('file-name-text');

                if (file) {
                    const ext = file.name.split('.').pop().toLowerCase();
                    if (!['jpg', 'jpeg', 'png', 'pdf'].includes(ext)) {
                        fileInput.value = '';
                        fileNameDisplay.classList.add('hidden');
                        tampilkanErrorBukti('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                        return;
                    }
                    if (file.size > 10 * 1024 * 1024) {
                        fileInput.value = '';
                        fileNameDisplay.classList.add('hidden');
                        tampilkanErrorBukti('Ukuran file melebihi 10MB.');
                        return;
                    }
                    tampilkanErrorBukti('');
                }

                if (fileName) {
                    fileNameText.textContent = fileName;
                    fileNameDisplay.classList.remove('hidden');
                    // Auto-scroll to display file name after selection
                    fileNameDisplay.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    fileNameDisplay.classList.add('hidden');
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropArea.classList.add('border-primary', 'bg-emerald-50');
            }

            function unhighlight() {
                dropArea.classList.remove('border-primary', 'bg-emerald-50');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;

                // Trigger change event
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            }
        }

        function copyToClipboard(text, btn) {
            navigator.clipboard.writeText(text).then(function() {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check text-xs"></i> <span>Tersalin!</span>';
                btn.classList.add('bg-emerald-200');
                setTimeout(function() {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('bg-emerald-200');
                }, 2000);
            }).catch(function(err) {
                console.error('Gagal menyalin: ', err);
            });
        }
    </script>
@endsection