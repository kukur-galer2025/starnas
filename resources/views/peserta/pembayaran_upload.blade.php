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
                $statusBayar = [
                    'pending'  => ['Menunggu Verifikasi', 'bg-amber-100 text-amber-800 border-amber-200', 'fa-clock'],
                    'verified' => ['Terverifikasi', 'bg-green-100 text-green-800 border-green-200', 'fa-check-circle'],
                    'rejected' => ['Ditolak, unggah ulang', 'bg-red-100 text-red-800 border-red-200', 'fa-times-circle'],
                ];
                $canUpload = $bolehPemakalah || $bolehNonPresenter;
                // Catatan penolakan untuk target yang sedang dipilih
                $ditolakSebelumnya = $dipilih?->pembayaranTerakhir?->status === 'rejected'
                    ? $dipilih->pembayaranTerakhir
                    : (!$dipilih && $nonPresenter?->status === 'rejected' ? $nonPresenter : null);
            @endphp

            {{-- PEMBAYARAN PER ABSTRAK --}}
            @if($abstraks->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-800 flex items-center mb-1">
                        <i class="fas fa-layer-group text-primary mr-2"></i> Pembayaran per Abstrak
                    </h4>
                    <p class="text-xs text-gray-500 mb-4">Setiap abstrak yang dipresentasikan dibayar terpisah. Pilih abstrak yang akan dibayar.</p>

                    <div class="space-y-3">
                        @foreach($abstraks as $abs)
                            @php
                                $bayarAbs = $abs->pembayaranTerakhir;
                                $aktif = $dipilih && $dipilih->id === $abs->id;
                            @endphp
                            <div class="rounded-xl border p-4 transition {{ $aktif ? 'border-primary bg-emerald-50/60 ring-2 ring-primary/20' : 'border-gray-200' }}">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500">Abstrak #{{ $loop->iteration }}</p>
                                        <p class="text-sm font-semibold text-gray-900 leading-snug">{{ $abs->judul_abstrak }}</p>
                                        <div class="mt-1.5 flex flex-wrap gap-1.5">
                                            @if($bayarAbs)
                                                @php [$lbl, $cls, $ico] = $statusBayar[$bayarAbs->status] ?? [ucfirst($bayarAbs->status), 'bg-gray-100 text-gray-700 border-gray-200', 'fa-question-circle']; @endphp
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $cls }}">
                                                    <i class="fas {{ $ico }} mr-1"></i> {{ $lbl }}
                                                </span>
                                            @elseif($abs->status_abstrak === 'diterima')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-gray-100 text-gray-700 border-gray-200">
                                                    <i class="fas fa-wallet mr-1"></i> Belum dibayar
                                                </span>
                                            @elseif($abs->status_abstrak === 'ditolak')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-red-50 text-red-700 border-red-200">Abstrak ditolak</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border bg-yellow-50 text-yellow-800 border-yellow-200">
                                                    <i class="fas fa-hourglass-half mr-1"></i> Menunggu review abstrak
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($abs->bisa_dibayar)
                                        @if($aktif)
                                            <span class="shrink-0 inline-flex items-center px-4 py-2 rounded-xl bg-primary text-white text-xs font-bold">
                                                <i class="fas fa-check mr-1.5"></i> Dipilih
                                            </span>
                                        @else
                                            <a href="{{ route('peserta.pembayaran.upload', ['abstrak' => $abs->id]) }}#form-bukti"
                                               class="shrink-0 inline-flex items-center px-4 py-2 rounded-xl border border-primary text-primary hover:bg-emerald-50 text-xs font-bold transition">
                                                <i class="fas fa-wallet mr-1.5"></i> Bayar abstrak ini
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ALERT: TIDAK ADA YANG PERLU DIBAYAR --}}
            @if(!$canUpload)
                <div
                    class="bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-primary text-emerald-950 p-6 rounded-2xl shadow-lg">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-2xl text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-lg mb-2 text-emerald-900">Status Upload</h4>
                            @if($abstraks->contains(fn ($a) => $a->status_abstrak === 'pending' && !$a->pembayaranTerakhir))
                                <p class="text-emerald-800 leading-relaxed">
                                    <strong class="text-emerald-700">Semua pembayaran yang tersedia sudah diproses.</strong>
                                    Abstrak lain yang masih direview dapat dibayar setelah diterima.
                                </p>
                            @else
                                <p class="text-emerald-800 leading-relaxed">
                                    <strong class="text-emerald-600">Semua pembayaran Anda sudah diunggah.</strong>
                                    Pantau statusnya di halaman <a href="{{ route('peserta.riwayat') }}" class="underline font-semibold">Riwayat Status</a>.
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
                                        <option value="asasi_onsite" @disabled(!$bolehPemakalah)>Anggota ASASI (Pemakalah Onsite) — Rp 450.000</option>
                                        <option value="umum_onsite" @disabled(!$bolehPemakalah)>Umum (Pemakalah Onsite) — Rp 500.000</option>
                                        <option value="mahasiswa_onsite" @disabled(!$bolehPemakalah)>Mahasiswa (Pemakalah Onsite) — Rp 250.000</option>
                                    </optgroup>
                                    <optgroup label="💻 KATEGORI ONLINE (VIRTUAL ZOOM)">
                                        <option value="asasi_online" @disabled(!$bolehPemakalah)>Anggota ASASI (Pemakalah Online) — Rp 250.000</option>
                                        <option value="umum_online" @disabled(!$bolehPemakalah)>Umum (Pemakalah Online) — Rp 300.000</option>
                                        <option value="mahasiswa_online" @disabled(!$bolehPemakalah)>Mahasiswa (Pemakalah Online) — Rp 150.000</option>
                                        <option value="non-presenter" @disabled(!$bolehNonPresenter)>Non Presenter (Online) — Rp 100.000</option>
                                    </optgroup>
                                </select>
                                @if(!$bolehPemakalah)
                                    <p class="mt-2 text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Kategori pemakalah baru bisa dipilih untuk abstrak yang sudah <strong>diterima</strong> dan belum dibayar.
                                        <a href="{{ route('peserta.abstrak.upload') }}" class="underline font-semibold">Kelola abstrak</a>.
                                        @if($bolehNonPresenter) Jika hanya hadir tanpa presentasi, pilih <strong>Non Presenter</strong>. @endif
                                    </p>
                                @endif
                            </div>

                            {{-- Field: Abstrak yang dibayar (kategori pemakalah) --}}
                            <div id="pilih-abstrak" class="hidden">
                                <label for="abstrak_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-file-lines text-primary mr-2"></i>
                                    Abstrak yang Dibayar <span class="text-red-500">*</span>
                                </label>
                                <select id="abstrak_id" name="abstrak_id" disabled
                                    class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-300">
                                    @foreach($abstraks->where('bisa_dibayar', true) as $abs)
                                        <option value="{{ $abs->id }}" @selected($dipilih && $dipilih->id === $abs->id)>{{ \Illuminate\Support\Str::limit($abs->judul_abstrak, 90) }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-2">Satu bukti transfer untuk satu abstrak.</p>
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
                            @if($ditolakSebelumnya)
                                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-exclamation-triangle text-red-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <h5 class="font-semibold text-red-800 text-sm">Bukti Sebelumnya Ditolak</h5>
                                            <p class="text-red-700 text-xs mt-1">
                                                Catatan Admin:
                                                <strong>{{ $ditolakSebelumnya->catatan_admin ?? 'Tidak ada catatan' }}</strong>
                                            </p>
                                            <p class="text-red-600 text-xs mt-2">Silakan unggah bukti pembayaran yang baru.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" id="btn-kirim-bukti"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-600/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-3"></i>
                                Kirim Bukti Pembayaran
                            </button>
                        </div>

                        @include('peserta.partials.upload-progress', ['id' => 'progress-bukti'])
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
            
            {{-- STATUS CARD: ringkasan semua pembayaran (per abstrak + non presenter) --}}
            @php
                $semuaBayar = $abstraks->pluck('pembayaranTerakhir')->push($nonPresenter)->filter();
                $belumDibayar = $abstraks->filter(fn ($a) => $a->bisa_dibayar && !$a->pembayaranTerakhir)->count();
                $jumlah = fn ($st) => $semuaBayar->where('status', $st)->count();
                $warnaKartu = $jumlah('rejected') ? 'border-red-500' : ($jumlah('pending') ? 'border-orange-500' : ($semuaBayar->isNotEmpty() && !$belumDibayar ? 'border-green-500' : 'border-red-500'));
            @endphp
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 {{ $warnaKartu }}">
                <h4 class="text-lg font-bold text-gray-800 mb-4">Status Verifikasi</h4>

                @if($semuaBayar->isEmpty())
                    <p class="text-2xl font-bold text-red-500 mb-2">Belum Ada Bukti</p>
                    <p class="text-sm text-gray-600">Silakan unggah bukti transfer untuk memulai verifikasi</p>
                @else
                    <ul class="space-y-2 text-sm">
                        @foreach(['verified' => ['Terverifikasi', 'text-green-600', 'fa-check-circle'], 'pending' => ['Menunggu verifikasi', 'text-orange-500', 'fa-clock'], 'rejected' => ['Ditolak', 'text-red-500', 'fa-times-circle']] as $st => [$lbl, $warna, $ico])
                            @if($jumlah($st))
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2 text-gray-700"><i class="fas {{ $ico }} {{ $warna }}"></i> {{ $lbl }}</span>
                                    <strong class="{{ $warna }}">{{ $jumlah($st) }}</strong>
                                </li>
                            @endif
                        @endforeach
                        @if($belumDibayar)
                            <li class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-gray-700"><i class="fas fa-wallet text-gray-400"></i> Abstrak belum dibayar</span>
                                <strong class="text-gray-700">{{ $belumDibayar }}</strong>
                            </li>
                        @endif
                    </ul>
                    <a href="{{ route('peserta.riwayat') }}" class="mt-4 inline-flex text-xs font-semibold text-primary hover:underline">Lihat riwayat lengkap &rarr;</a>
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
        document.getElementById('kategori_pembayaran')?.addEventListener('change', function (e) {
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

            // Kategori pemakalah wajib memilih abstrak yang dibayar
            const pilihAbstrak = document.getElementById('pilih-abstrak');
            const abstrakSelect = document.getElementById('abstrak_id');
            const pemakalah = kategori && kategori !== 'non-presenter';
            pilihAbstrak.classList.toggle('hidden', !pemakalah);
            abstrakSelect.disabled = !pemakalah;
            pemakalah ? abstrakSelect.setAttribute('required', 'required') : abstrakSelect.removeAttribute('required');

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
            const formBukti = document.getElementById('form-bukti');
            formBukti.addEventListener('submit', function (e) {
                e.preventDefault();

                if (!fileInput.files.length) {
                    tampilkanErrorBukti('Silakan pilih file bukti pembayaran terlebih dahulu.');
                    dropArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                tampilkanErrorBukti('');
                kirimDenganProgress(formBukti, {
                    box: document.getElementById('progress-bukti'),
                    tombol: document.getElementById('btn-kirim-bukti'),
                    labelUpload: 'Mengunggah bukti pembayaran...',
                    onGagal: function (pesan) {
                        tampilkanErrorBukti(pesan);
                        dropArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    },
                });
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