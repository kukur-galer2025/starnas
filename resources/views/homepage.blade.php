@extends('peserta.layouts.app')

@section('content')

    <section id="home"
        class="gradient-bg pt-20 md:pt-32 pb-12 md:pb-20 text-white relative overflow-hidden content-padding hero-section">
        <div class="hero-particles" id="particles-container"></div>

        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 left-0 w-48 h-48 md:w-72 md:h-72 bg-emerald-400 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse">
            </div>
            <div class="absolute top-0 right-0 w-48 h-48 md:w-72 md:h-72 bg-amber-400 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-10 md:left-20 w-48 h-48 md:w-72 md:h-72 bg-teal-400 rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse"
                style="animation-delay: 4s;"></div>
        </div>

        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 flex-col-landscape">
                <div class="lg:w-1/2 text-center lg:text-left text-center-landscape" data-aos="fade-right">
                    <div
                        class="inline-flex items-center px-3 py-1 md:px-4 md:py-2 glass-effect rounded-full text-xs md:text-sm mb-4 md:mb-6 animate-pulse">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-ping"></span>
                        <i class="fas fa-calendar-alt mr-2"></i>1-2 Desember 2026 • Grand Hotel De Djokja
                    </div>

                    <h1 class="text-2xl md:text-4xl lg:text-5xl xl:text-6xl font-black mb-4 leading-tight">
                        <span
                            class="bg-gradient-to-r from-white via-amber-200 to-teal-200 bg-clip-text text-transparent">STARNAS ASASI & ICoABCD</span>
                        <span class="text-gradient bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300">2026</span>
                    </h1>

                    <div class="relative mb-4 md:mb-6">
                        <h2 class="text-lg md:text-xl lg:text-2xl xl:text-3xl font-bold text-amber-300 drop-shadow-lg">
                            Seminar Teknologi dan Sains Nasional ASASI & ICoABCD 2026
                        </h2>
                        <div
                            class="absolute -bottom-2 left-0 lg:left-0 w-24 md:w-32 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full">
                        </div>
                    </div>

                    <div class="flex items-start mb-6 md:mb-8 max-w-lg mx-auto lg:mx-0">
                        <div
                            class="w-6 h-6 md:w-8 md:h-8 bg-emerald-500 rounded-full flex items-center justify-center mr-3 mt-1 flex-shrink-0 shadow-lg shadow-emerald-500/30">
                            <i class="fas fa-robot text-white text-xs md:text-sm"></i>
                        </div>
                        <p class="text-sm md:text-base lg:text-lg text-emerald-100 font-medium">
                            AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 max-w-md mx-auto lg:mx-0">
                        <a href="#tentang"
                            class="group btn-primary py-3 px-6 rounded-xl text-center relative overflow-hidden text-sm md:text-base flex items-center justify-center">
                            <i class="fas fa-play-circle mr-2"></i>Pelajari Lebih Lanjut
                        </a>
                        <a href="#biaya"
                            class="group btn-secondary py-3 px-6 rounded-xl text-center relative overflow-hidden text-sm md:text-base flex items-center justify-center">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Pendaftaran
                        </a>
                    </div>

                    <div
                        class="flex justify-between md:justify-start md:space-x-8 lg:space-x-12 mt-6 md:mt-8 pt-4 md:pt-6 border-t border-white/20">
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-amber-300 mb-1"><i class="fas fa-rocket"></i>
                            </div>
                            <div class="text-xs md:text-sm text-emerald-200">Transformasi<br>Digital</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-teal-300 mb-1"><i class="fas fa-brain"></i></div>
                            <div class="text-xs md:text-sm text-emerald-200">Pengetahuan<br>Mendalam</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl md:text-2xl font-bold text-emerald-300 mb-1"><i class="fas fa-trophy"></i>
                            </div>
                            <div class="text-xs md:text-sm text-emerald-200">Kesempatan<br>Emas</div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 flex justify-center" data-aos="fade-left" data-aos-delay="300">
                    <div class="relative w-full max-w-xl">
                        <div class="hero-slider">
                            <div class="slide active" style="background-image: url('/storage/starnas-stage.jpg')"></div>
                            <div class="slide" style="background-image: url('/storage/venue-djokja.jpg')"></div>
                            <div class="slide" style="background-image: url('/storage/konferensi.png')"></div>

                            <button class="slider-arrow prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="slider-arrow next">
                                <i class="fas fa-chevron-right"></i>
                            </button>

                            <div class="slider-nav">
                                <div class="slider-dot active"></div>
                                <div class="slider-dot"></div>
                                <div class="slider-dot"></div>
                            </div>
                        </div>

                        <div
                            class="absolute -top-2 -right-2 md:-top-3 md:-right-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-2 py-1 md:px-3 md:py-1.5 rounded-full text-xs font-bold shadow-lg z-20 animate-bounce">
                            <i class="fas fa-fire mr-1"></i> Trending Event
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-4 md:bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <a href="#agenda" class="text-white animate-bounce flex flex-col items-center">
                <span class="text-xs md:text-sm mb-2 text-emerald-200">Jelajahi Lebih Lanjut</span>
                <i class="fas fa-chevron-down text-lg md:text-xl bg-white/20 p-2 rounded-full"></i>
            </a>
        </div>
    </section>

     <!-- SECTION UNDANGAN RESMI SEMINAR NASIONAL ASASI 2026 -->
    <section id="undangan"
        class="py-16 md:py-24 bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 relative overflow-hidden border-t border-emerald-500/10">
        <!-- Background Lighting Glows -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-10 left-10 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>
            <div
                class="absolute inset-0 opacity-5 bg-[linear-gradient(rgba(255,255,255,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.1)_1px,transparent_1px)] bg-[size:40px_40px]">
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <!-- Header Section -->
            <div class="text-center mb-12 md:mb-16" data-aos="fade-down">
                <div
                    class="inline-flex items-center px-4 py-2 glass-effect rounded-full text-xs md:text-sm mb-4 border border-amber-400/30">
                    <span class="w-2 h-2 bg-amber-400 rounded-full mr-2 animate-ping"></span>
                    <i class="fas fa-bullhorn mr-2 text-amber-300"></i>
                    <span class="text-amber-200 font-semibold tracking-wide">UNDANGAN RESMI PARTISIPASI</span>
                </div>
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-black text-white mb-4 leading-tight">
                    Seminar Nasional <span
                        class="bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent">ASASI
                        2026</span>
                </h2>
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-900/40 border border-emerald-500/30 rounded-xl text-emerald-200 text-xs md:text-sm font-medium mb-4">
                    <span>🤖⚡</span>
                    <span class="italic font-semibold">“AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian
                        Ekonomi dan Energi”</span>
                </div>
                <p class="text-slate-400 max-w-2xl mx-auto text-xs md:text-sm">
                    Diselenggarakan oleh <strong>Akademisi dan Saintis Indonesia (ASASI)</strong> • 1–2 Desember 2026 di
                    Grand Hotel De Djokja, Yogyakarta
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-7xl mx-auto">
                <!-- Kolom Kiri: Surat Undangan, Keynote, Tanggal Penting, Biaya & Fasilitas (7 Kolom) -->
                <div class="lg:col-span-7 space-y-6" data-aos="fade-right">

                    <!-- Card 1: Isi Surat Undangan Resmi -->
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 md:p-8 border border-white/10 shadow-2xl">
                        <div class="flex items-center gap-3 mb-4 text-amber-300 font-semibold text-sm md:text-base">
                            <i class="fas fa-envelope-open-text text-lg"></i>
                            <span>Assalamu’alaikum Warahmatullahi Wabarakatuh</span>
                        </div>
                        <p class="text-emerald-100 font-medium text-sm md:text-base mb-3">
                            Yth. Bapak/Ibu Pimpinan, Dosen, Peneliti, dan Rekan Sejawat,
                        </p>
                        <p class="text-slate-300 text-xs md:text-sm leading-relaxed mb-4">
                            Dengan hormat, melalui pesan ini kami mengundang Bapak/Ibu untuk berpartisipasi dalam
                            <strong>Seminar Nasional yang diselenggarakan oleh Akademisi dan Saintis Indonesia (ASASI)</strong>,
                            baik sebagai pemakalah (presenter) maupun peserta seminar.
                        </p>

                        <!-- Keynote Speakers Mini Pill -->
                        <div
                            class="bg-gradient-to-r from-emerald-950/80 to-slate-900/90 rounded-xl p-4 border border-emerald-500/30 mb-4">
                            <div
                                class="text-xs font-bold text-amber-300 uppercase tracking-wider mb-2.5 flex items-center gap-2">
                                <i class="fas fa-microphone-alt"></i> Keynote Speakers Resmi:
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                <div class="p-2.5 rounded-lg bg-white/5 border border-white/10">
                                    <div class="font-bold text-white text-sm">Prof. Yassierli, S.T., M.T., Ph.D</div>
                                    <div class="text-emerald-300 text-[11px] font-medium">Menteri Tenaga Kerja RI</div>
                                </div>
                                <div class="p-2.5 rounded-lg bg-white/5 border border-white/10">
                                    <div class="font-bold text-white text-sm">Prof. Dr. Ir. Andi Adriansyah, M.Eng</div>
                                    <div class="text-emerald-300 text-[11px] font-medium">Rektor Universitas Mercu Buana Jakarta</div>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Pill -->
                        <div
                            class="flex flex-wrap items-center gap-2 text-xs text-slate-300 bg-white/5 p-3 rounded-xl border border-white/10">
                            <span class="inline-flex items-center text-amber-300 font-semibold"><i
                                    class="fas fa-calendar-check mr-1.5"></i> 1-2 Desember 2026</span>
                            <span class="text-slate-500">•</span>
                            <span class="inline-flex items-center text-teal-300 font-semibold"><i
                                    class="fas fa-clock mr-1.5"></i> 08.00 WIB - Selesai</span>
                            <span class="text-slate-500">•</span>
                            <span class="inline-flex items-center text-emerald-300 font-semibold"><i
                                    class="fas fa-map-marker-alt mr-1.5"></i> Grand Hotel De Djokja, Yogyakarta</span>
                        </div>
                    </div>

                    <!-- Card 2: Tanggal Penting (Important Dates) -->
                    <div
                        class="bg-gradient-to-br from-emerald-950/60 via-slate-900 to-slate-950 rounded-2xl p-6 md:p-8 border border-emerald-500/30 shadow-xl">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-base md:text-lg font-bold text-white flex items-center gap-2">
                                <i class="fas fa-calendar-alt text-amber-400"></i> Tanggal-Tanggal Penting
                            </h3>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-300 border border-amber-400/30">
                                Segera Kirim
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                            <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-400/40 relative">
                                <div class="text-[11px] font-bold text-amber-300 uppercase">Deadline Abstrak</div>
                                <div class="text-lg font-black text-white">14 November 2026</div>
                                <div class="text-[11px] text-amber-200/90 mt-0.5">Tersisa sekitar 3 minggu</div>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[11px] font-bold text-teal-300 uppercase">Notifikasi Penerimaan</div>
                                <div class="text-lg font-black text-white">18 November 2026</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Pengumuman seleksi abstrak</div>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[11px] font-bold text-emerald-300 uppercase">Deadline Registrasi</div>
                                <div class="text-lg font-black text-white">21 November 2026</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Batas akhir pembayaran</div>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white/5 border border-white/10">
                                <div class="text-[11px] font-bold text-teal-300 uppercase">Deadline Full Paper</div>
                                <div class="text-lg font-black text-white">28 November 2026</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Naskah lengkap siap prosiding</div>
                            </div>
                        </div>

                        <!-- Himbauan Callout -->
                        <div
                            class="p-3.5 bg-amber-500/15 border-l-4 border-amber-400 rounded-r-xl text-xs text-amber-100 leading-relaxed">
                            <strong>⏳ Catatan Panitia:</strong> Mengingat batas akhir pengiriman abstrak tinggal sekitar
                            tiga minggu lagi (14 November 2026), kami mengimbau Bapak/Ibu untuk segera mengirimkan abstrak
                            dan melakukan pendaftaran agar tidak terlewat.
                        </div>
                    </div>

                    <!-- Card 3: Biaya Pendaftaran & Fasilitas Lengkap -->
                    <div class="bg-white/5 backdrop-blur-xl rounded-2xl p-6 md:p-8 border border-white/10 shadow-xl">
                        <h3 class="text-base md:text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <i class="fas fa-tags text-emerald-400"></i> Biaya Pendaftaran Seminar
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Kolom Onsite -->
                            <div class="p-4 rounded-xl bg-emerald-950/40 border border-emerald-500/30">
                                <div class="flex items-center justify-between mb-3 pb-2 border-b border-emerald-500/20">
                                    <span class="font-bold text-emerald-300 text-sm flex items-center gap-1.5">
                                        <i class="fas fa-hotel"></i> Kategori Onsite
                                    </span>
                                    <span
                                        class="text-[10px] bg-emerald-500/20 text-emerald-200 px-2 py-0.5 rounded font-semibold">Grand
                                        Hotel De Djokja</span>
                                </div>
                                <ul class="space-y-2 text-xs">
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Anggota ASASI</span>
                                        <strong class="text-white text-sm">Rp 450.000</strong>
                                    </li>
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Umum</span>
                                        <strong class="text-white text-sm">Rp 500.000</strong>
                                    </li>
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Mahasiswa</span>
                                        <strong class="text-white text-sm">Rp 250.000</strong>
                                    </li>
                                </ul>
                            </div>

                            <!-- Kolom Online -->
                            <div class="p-4 rounded-xl bg-teal-950/40 border border-teal-500/30">
                                <div class="flex items-center justify-between mb-3 pb-2 border-b border-teal-500/20">
                                    <span class="font-bold text-teal-300 text-sm flex items-center gap-1.5">
                                        <i class="fas fa-video"></i> Kategori Online
                                    </span>
                                    <span
                                        class="text-[10px] bg-teal-500/20 text-teal-200 px-2 py-0.5 rounded font-semibold">Virtual
                                        Zoom</span>
                                </div>
                                <ul class="space-y-2 text-xs">
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Anggota ASASI</span>
                                        <strong class="text-white text-sm">Rp 250.000</strong>
                                    </li>
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Umum</span>
                                        <strong class="text-white text-sm">Rp 300.000</strong>
                                    </li>
                                    <li class="flex justify-between items-center text-slate-300">
                                        <span>Mahasiswa</span>
                                        <strong class="text-white text-sm">Rp 150.000</strong>
                                    </li>
                                    <li
                                        class="flex justify-between items-center text-slate-300 pt-1.5 border-t border-white/10">
                                        <span class="text-amber-200 font-medium">Non Presenter</span>
                                        <strong class="text-amber-300 text-sm">Rp 100.000</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div
                            class="p-3.5 bg-gradient-to-r from-emerald-900/40 to-teal-900/30 rounded-xl border border-emerald-500/20 mb-4">
                            <div class="text-xs font-bold text-emerald-300 mb-1 flex items-center gap-2">
                                <i class="fas fa-gift text-amber-400"></i> Fasilitas Semua Peserta:
                            </div>
                            <div class="flex flex-wrap gap-4 text-xs text-slate-200 font-medium">
                                <span class="flex items-center gap-1.5"><i
                                        class="fas fa-check-circle text-emerald-400"></i> Sertifikat Resmi</span>
                                <span class="flex items-center gap-1.5"><i
                                        class="fas fa-check-circle text-emerald-400"></i> Prosiding / Book Chapter
                                    ber-ISBN</span>
                            </div>
                        </div>

                        <!-- Tombol Aksi & Narahubung WA -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <a href="{{ route('register') }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl font-bold text-slate-950 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 transition-all duration-300 shadow-lg shadow-amber-500/20 text-sm text-center">
                                <i class="fas fa-paper-plane"></i> Daftar & Kirim Abstrak
                            </a>
                            <a href="https://wa.me/6285225519882?text=Halo%20Panitia%20Seminar%20Nasional%20ASASI%202026,%20saya%20ingin%20bertanya%20mengenai%20pendaftaran"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 py-3 px-5 rounded-xl font-bold text-white bg-emerald-600 hover:bg-emerald-500 transition-all duration-300 shadow-lg shadow-emerald-600/30 text-sm">
                                <i class="fab fa-whatsapp text-lg text-emerald-200"></i>
                                <span>Narahubung: 085225519882</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Kolom Kanan: Banner Resmi Terbaru 2026 (5 Kolom) -->
                <div class="lg:col-span-5" data-aos="fade-left">
                    <div class="sticky top-28 space-y-4">
                        <div
                            class="bg-gradient-to-br from-slate-900 to-emerald-950 p-2 md:p-3 rounded-2xl md:rounded-3xl border-2 border-emerald-500/40 shadow-2xl relative group">

                            <!-- Badge Poster Resmi -->
                            <div
                                class="absolute -top-3.5 left-6 bg-gradient-to-r from-amber-500 to-orange-500 text-slate-950 px-3.5 py-1 rounded-full text-xs font-black shadow-lg z-20 flex items-center gap-1.5 border border-amber-300">
                                <i class="fas fa-star text-xs"></i> BANNER RESMI 2026
                            </div>

                            <div class="overflow-hidden rounded-xl md:rounded-2xl relative bg-slate-900">
                                <img src="{{ asset('storage/banner-starnas-2026.jpeg') }}"
                                    alt="Banner Resmi Seminar Nasional ASASI 2026"
                                    class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-105">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <a href="{{ asset('storage/banner-starnas-2026.jpeg') }}" target="_blank"
                                        class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl text-xs font-bold text-center flex items-center justify-center gap-2 shadow-lg">
                                        <i class="fas fa-search-plus"></i> Lihat Ukuran Penuh
                                    </a>
                                </div>
                            </div>

                            <div class="p-3 text-center">
                                <p class="text-xs text-emerald-200 font-medium">
                                    <i class="fas fa-check-circle text-emerald-400 mr-1"></i> Poster Resmi Seminar Nasional
                                    ASASI 2026
                                </p>
                            </div>
                        </div>

                        <!-- Direct WhatsApp Quick Card -->
                        <div class="p-4 rounded-2xl bg-white/5 border border-white/10 text-center">
                            <p class="text-xs text-slate-400 mb-2">Butuh bantuan atau informasi narahubung?</p>
                            <a href="https://wa.me/6285225519882?text=Halo%20Panitia%20Seminar%20Nasional%20ASASI%202026"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-xs font-bold text-amber-300 hover:text-amber-200 transition-colors">
                                <i class="fab fa-whatsapp text-emerald-400 text-sm"></i> Chat Panitia: 085225519882
                                (WhatsApp)
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section
        class="py-12 md:py-16 bg-gradient-to-r from-slate-950 via-emerald-950 to-slate-900 text-white relative overflow-hidden border-y border-emerald-500/20">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-16 h-16 md:w-20 md:h-20 border-2 border-emerald-400 rounded-full"></div>
            <div class="absolute top-20 right-10 md:right-20 w-10 h-10 md:w-12 md:h-12 border-2 border-teal-400 rounded-full">
            </div>
            <div class="absolute bottom-20 left-10 md:left-20 w-12 h-12 md:w-16 md:h-16 border-2 border-emerald-400 rounded-full">
            </div>
        </div>

        <div class="container mx-auto px-4 md:px-6 relative z-10">
            <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 bg-gradient-to-r from-white via-emerald-200 to-amber-200 bg-clip-text text-transparent">Acara Akan Dimulai Dalam</h2>
                <p class="text-emerald-200 max-w-2xl mx-auto text-sm md:text-base px-4">Jangan lewatkan kesempatan untuk
                    menjadi bagian dari revolusi AI dan kemandirian ekonomi & energi. Segera daftar dan pastikan tempat Anda!</p>
            </div>

            <div class="flex justify-center space-x-2 md:space-x-4 lg:space-x-6 px-4" data-aos="fade-up"
                data-aos-delay="200">
                <div class="countdown-item rounded-xl md:rounded-2xl p-3 md:p-4 text-center w-14 md:w-16 lg:w-20 xl:w-24">
                    <div class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold mb-1 md:mb-2 text-amber-300 drop-shadow-lg"
                        id="days">00</div>
                    <div class="text-xs font-semibold text-emerald-200">Hari</div>
                </div>

                <div class="countdown-item rounded-xl md:rounded-2xl p-3 md:p-4 text-center w-14 md:w-16 lg:w-20 xl:w-24">
                    <div class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold mb-1 md:mb-2 text-teal-300 drop-shadow-lg"
                        id="hours">00</div>
                    <div class="text-xs font-semibold text-emerald-200">Jam</div>
                </div>

                <div class="countdown-item rounded-xl md:rounded-2xl p-3 md:p-4 text-center w-14 md:w-16 lg:w-20 xl:w-24">
                    <div class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold mb-1 md:mb-2 text-emerald-300 drop-shadow-lg"
                        id="minutes">00</div>
                    <div class="text-xs font-semibold text-emerald-200">Menit</div>
                </div>

                <div class="countdown-item rounded-xl md:rounded-2xl p-3 md:p-4 text-center w-14 md:w-16 lg:w-20 xl:w-24">
                    <div class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold mb-1 md:mb-2 text-amber-300 drop-shadow-lg"
                        id="seconds">00</div>
                    <div class="text-xs font-semibold text-emerald-200">Detik</div>
                </div>
            </div>

            <div class="text-center mt-8 md:mt-12 px-4" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-600 hover:from-emerald-400 hover:to-teal-500 text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl text-sm md:text-base">
                    <i class="fas fa-ticket-alt mr-2 md:mr-3"></i>
                    Daftar Sekarang - Kuota Terbatas!
                </a>
            </div>
        </div>
    </section>

    <section id="agenda" class="py-28 bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 relative overflow-hidden border-t border-emerald-500/10">
        <div class="absolute inset-0">
            <div
                class="absolute top-10 left-10 w-96 h-96 bg-gradient-to-r from-emerald-500/15 to-teal-500/15 rounded-full blur-3xl animate-pulse-slow">
            </div>
            <div
                class="absolute top-1/3 right-20 w-80 h-80 bg-gradient-to-r from-teal-500/20 to-emerald-500/20 rounded-full blur-3xl animate-float">
            </div>
            <div class="absolute bottom-20 left-1/4 w-72 h-72 bg-gradient-to-r from-amber-500/20 to-orange-500/20 rounded-full blur-3xl animate-pulse-slow"
                style="animation-delay: 2s;"></div>

            <div
                class="absolute inset-0 opacity-10 bg-[linear-gradient(rgba(255,255,255,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.1)_1px,transparent_1px)] bg-[size:50px_50px]">
            </div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-24" data-aos="fade-down" data-aos-duration="1000">
                <div
                    class="inline-flex items-center justify-center w-28 h-28 bg-gradient-to-br from-emerald-500 via-teal-500 to-emerald-700 rounded-3xl mb-8 shadow-2xl relative group">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity duration-500">
                    </div>
                    <i class="fas fa-crown text-white text-3xl relative z-10"></i>
                </div>

                <div class="relative inline-block mb-8">
                    <h2
                        class="text-5xl md:text-6xl font-black text-white mb-4 bg-gradient-to-r from-white via-emerald-200 to-teal-200 bg-clip-text text-transparent">
                        AGENDA UTAMA
                    </h2>
                    <div
                        class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-48 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full">
                    </div>
                    <div
                        class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-gradient-to-r from-amber-400 to-emerald-400 rounded-full opacity-60">
                    </div>
                </div>

                <p class="text-xl text-emerald-200 max-w-4xl mx-auto leading-relaxed font-light">
                    Jelajahi puncak keunggulan akademik melalui rangkaian acara premium kami yang
                    dirancang untuk menginspirasi inovasi dan mendorong kolaborasi yang mengubah paradigma.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">

                <div class="group relative" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-800 rounded-3xl blur-lg opacity-60 group-hover:opacity-80 transition-all duration-700 animate-gradient-x">
                    </div>
                    <div
                        class="relative bg-gradient-to-br from-slate-900 to-emerald-950 rounded-3xl border border-white/10 backdrop-blur-xl shadow-2xl overflow-hidden transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-4xl h-full flex flex-col">

                        <div
                            class="relative p-8 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 border-b border-white/10 overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-20 translate-x-20">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-500/10 rounded-full translate-y-16 -translate-x-16">
                            </div>

                            <div class="relative z-10 text-center">
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm text-white mb-4 border border-white/20">
                                    <i class="fas fa-users mr-2 text-emerald-300"></i>KOORDINASI NASIONAL
                                </div>

                                <h3 class="text-2xl font-bold text-white mb-2">RAKORNAS ASASI</h3>
                                <div
                                    class="text-3xl font-black bg-gradient-to-r from-amber-300 to-amber-400 bg-clip-text text-transparent mb-2">
                                    2026</div>
                                <p class="text-emerald-200 text-sm">Perkumpulan Akademisi dan Saintis Indonesia</p>
                            </div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex-grow flex flex-col items-center justify-center text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-handshake text-white text-xl"></i>
                                </div>

                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Pertemuan nasional eksklusif untuk koordinasi strategis dan sinergi antar anggota
                                    utama
                                    ASASI seluruh Indonesia.
                                </p>

                                <div class="flex justify-center space-x-4 text-xs text-emerald-300">
                                    <span class="flex items-center">
                                        <i class="fas fa-users mr-1"></i> Sesi Networking
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-comments mr-1"></i> Forum Diskusi Nasional
                                    </span>
                                </div>

                            </div>

                            <a href="{{ route('rundown.rakornas') }}"
                                class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center mt-6">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                LIHAT RUNDOWN RAKORNAS
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group relative" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-amber-500 via-emerald-500 to-teal-500 rounded-3xl blur-lg opacity-60 group-hover:opacity-80 transition-all duration-700 animate-gradient-x">
                    </div>
                    <div
                        class="relative bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl border border-white/10 backdrop-blur-xl shadow-2xl overflow-hidden transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-4xl h-full flex flex-col">

                        <div
                            class="relative p-8 bg-gradient-to-br from-amber-500/20 to-emerald-600/20 border-b border-white/10 overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-20 translate-x-20">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-amber-500/10 rounded-full translate-y-16 -translate-x-16">
                            </div>

                            <div class="relative z-10 text-center">
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm text-white mb-4 border border-white/20">
                                    <i class="fas fa-chalkboard-teacher mr-2 text-amber-300"></i>SEMINAR UTAMA
                                </div>

                                <h3 class="text-2xl font-bold text-white mb-2">STARNAS ASASI & ICoABCD 2026</h3>
                                <div
                                    class="text-xl font-semibold bg-gradient-to-r from-amber-300 to-emerald-300 bg-clip-text text-transparent mb-2">
                                    Seminar Teknologi dan Sains Nasional </div>
                                <p class="text-emerald-200 text-sm">Forum Berbagi Pengetahuan Terdepan</p>
                            </div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex-grow flex flex-col items-center justify-center text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-amber-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-microphone-alt text-white text-xl"></i>
                                </div>

                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Seminar nasional utama yang menghadirkan pembicara terkemuka berbagi wawasan
                                    terdepan
                                    dalam bidang sains dan teknologi.
                                </p>

                                <div class="flex justify-center space-x-4 text-xs text-amber-300">
                                    <span class="flex items-center">
                                        <i class="fas fa-medal mr-1"></i> Keynote Sessions
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-network-wired mr-1"></i> Networking Profesional
                                    </span>
                                </div>

                            </div>

                            <a href="{{ route('rundown.starnas') }}"
                                class="w-full bg-gradient-to-r from-amber-500 via-emerald-600 to-teal-600 hover:from-amber-600 hover:to-emerald-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center mt-6">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                LIHAT RUNDOWN LENGKAP
                            </a>
                        </div>
                    </div>
                </div>

                <div class="group relative" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-emerald-600 via-green-600 to-emerald-800 rounded-3xl blur-lg opacity-60 group-hover:opacity-80 transition-all duration-700 animate-gradient-x">
                    </div>
                    <div
                        class="relative bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl border border-white/10 backdrop-blur-xl shadow-2xl overflow-hidden transform transition-all duration-700 group-hover:scale-105 group-hover:shadow-4xl h-full flex flex-col">

                        <div
                            class="relative p-8 bg-gradient-to-br from-emerald-600/20 to-green-600/20 border-b border-white/10 overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -translate-y-20 translate-x-20">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-32 h-32 bg-green-500/10 rounded-full translate-y-16 -translate-x-16">
                            </div>

                            <div class="relative z-10 text-center">
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm text-white mb-4 border border-white/20">
                                    <i class="fas fa-globe-americas mr-2 text-emerald-300"></i>KONFERENSI INTERNASIONAL
                                </div>

                                <h3 class="text-2xl font-bold text-white mb-2">ICoABCD</h3>
                                <div
                                    class="text-lg font-semibold bg-gradient-to-r from-green-300 to-emerald-400 bg-clip-text text-transparent mb-2">
                                    Konferensi Internasional AI, Blockchain, Cloud & Data Analytics
                                </div>
                                <p class="text-emerald-200 text-sm">Platform Global untuk Inovasi Teknologi</p>
                            </div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex-grow flex flex-col items-center justify-center text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                                </div>

                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Konferensi internasional kelas dunia yang mengeksplorasi kemajuan terdepan dalam AI,
                                    Blockchain, Cloud Computing, dan Data Analytics.
                                </p>

                                <div class="flex justify-center space-x-4 text-xs text-emerald-300">
                                    <span class="flex items-center">
                                        <i class="fas fa-earth-americas mr-1"></i> Global Speakers
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-rocket mr-1"></i> Innovation Showcase
                                    </span>
                                </div>
                            </div>

                            <a href="https://icoabcd.asasi.or.id/"
                                class="w-full bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center mt-6"
                                target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-info-circle mr-2"></i>
                                INFO LEBIH LANJUT
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="800">
                <div
                    class="bg-gradient-to-br from-white/5 to-white/10 rounded-3xl p-12 shadow-2xl border border-white/10 backdrop-blur-2xl relative overflow-hidden">
                    <div class="absolute inset-0">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full -translate-y-32 translate-x-32 animate-pulse-slow">
                        </div>
                        <div class="absolute bottom-0 left-0 w-48 h-48 bg-amber-500/10 rounded-full translate-y-24 -translate-x-24 animate-pulse-slow"
                            style="animation-delay: 1.5s;"></div>
                    </div>

                    <div class="relative z-10">
                        <h3
                            class="text-3xl font-bold text-center text-white mb-12 bg-gradient-to-r from-white via-emerald-200 to-teal-200 bg-clip-text text-transparent">
                            Keunggulan Acara Premium Kami
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="text-center group">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-crown text-white text-2xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-3">Pengalaman Elite</h4>
                                <p class="text-emerald-200 text-sm leading-relaxed">
                                    Nikmati acara kelas dunia dengan fasilitas premium dan akses eksklusif kepada
                                    pemimpin
                                    industri.
                                </p>
                            </div>

                            <div class="text-center group">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-brain text-white text-2xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-3">Konten Terdepan</h4>
                                <p class="text-emerald-200 text-sm leading-relaxed">
                                    Akses penelitian terobosan dan ide-ide inovatif dari pemikir terbaik dalam sains dan
                                    teknologi.
                                </p>
                            </div>

                            <div class="text-center group">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-500">
                                    <i class="fas fa-handshake-angle text-white text-2xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-white mb-3">Kemitraan Strategis</h4>
                                <p class="text-emerald-200 text-sm leading-relaxed">
                                    Bangun koneksi berharga dan kolaborasi yang mendorong inovasi dan menciptakan dampak
                                    berkelanjutan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="timeline" class="py-12 md:py-20 bg-gradient-to-br from-slate-50 via-emerald-50/30 to-teal-50/20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <h2 class="text-2xl md:text-4xl font-bold text-slate-900 section-title">TIMELINE STARNAS ASASI</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-lg">Jangan lewatkan tanggal-tanggal penting
                    dalam
                    pelaksanaan seminar ini.</p>
            </div>

            <div class="w-full" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-gradient-to-r from-emerald-800 via-teal-900 to-slate-950 rounded-3xl shadow-2xl border border-emerald-500/20 overflow-hidden">
                    <div class="bg-white/10 backdrop-blur-sm p-6 md:p-8 text-center text-white border-b border-white/20">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-white/20 rounded-2xl mb-4">
                            <i class="fas fa-clock text-white text-xl md:text-2xl"></i>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-3">Timeline STARNAS ASASI & ICoABCD 2026</h3>
                        <p class="text-emerald-100 text-base md:text-lg">Pastikan Anda mengikuti timeline yang telah
                            ditetapkan
                        </p>
                    </div>

                    <div class="p-4 md:p-8">
                        <div class="space-y-4 md:space-y-6">
                            <div
                                class="flex flex-col md:flex-row items-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-white hover-lift transition-all duration-300 hover:bg-emerald-500/15 relative">
                                <div class="flex-shrink-0 w-full md:w-32 text-center mb-4 md:mb-0">
                                    <div class="text-xl md:text-2xl font-bold mb-1">15 NOV</div>
                                    <div class="text-base md:text-lg font-semibold text-emerald-200">2026</div>
                                </div>
                                <div
                                    class="flex-1 md:ml-6 md:pl-6 md:border-l-2 md:border-white/30 border-t-2 md:border-t-0 border-white/30 pt-4 md:pt-0 w-full text-center md:text-left">
                                    <h4 class="text-lg md:text-xl font-bold mb-2">Batas Pengumpulan Abstrak</h4>
                                    <p class="text-emerald-100/90 text-sm md:text-base">Batas akhir pengumpulan abstrak untuk
                                        seminar</p>
                                </div>
                                <div class="absolute top-4 right-4 md:static md:ml-4">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col md:flex-row items-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-white hover-lift transition-all duration-300 hover:bg-emerald-500/15 relative">
                                <div class="flex-shrink-0 w-full md:w-32 text-center mb-4 md:mb-0">
                                    <div class="text-xl md:text-2xl font-bold mb-1">24 NOV</div>
                                    <div class="text-base md:text-lg font-semibold text-emerald-200">2026</div>
                                </div>
                                <div
                                    class="flex-1 md:ml-6 md:pl-6 md:border-l-2 md:border-white/30 border-t-2 md:border-t-0 border-white/30 pt-4 md:pt-0 w-full text-center md:text-left">
                                    <h4 class="text-lg md:text-xl font-bold mb-2">Batas Akhir Pengumpulan Makalah</h4>
                                    <p class="text-emerald-100/90 text-sm md:text-base">Batas akhir pengumpulan makalah
                                        lengkap
                                    </p>
                                </div>
                                <div class="absolute top-4 right-4 md:static md:ml-4">
                                    <div class="w-3 h-3 bg-teal-300 rounded-full"></div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col md:flex-row items-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-white hover-lift transition-all duration-300 hover:bg-emerald-500/15 relative">
                                <div class="flex-shrink-0 w-full md:w-32 text-center mb-4 md:mb-0">
                                    <div class="text-xl md:text-2xl font-bold mb-1">25 NOV</div>
                                    <div class="text-base md:text-lg font-semibold text-emerald-200">2026</div>
                                </div>
                                <div
                                    class="flex-1 md:ml-6 md:pl-6 md:border-l-2 md:border-white/30 border-t-2 md:border-t-0 border-white/30 pt-4 md:pt-0 w-full text-center md:text-left">
                                    <h4 class="text-lg md:text-xl font-bold mb-2">Pengumuman Penerimaan Makalah</h4>
                                    <p class="text-emerald-100/90 text-sm md:text-base">Pengumuman makalah yang diterima untuk
                                        presentasi</p>
                                </div>
                                <div class="absolute top-4 right-4 md:static md:ml-4">
                                    <div class="w-3 h-3 bg-emerald-400 rounded-full"></div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col md:flex-row items-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-white hover-lift transition-all duration-300 hover:bg-emerald-500/15 relative">
                                <div class="flex-shrink-0 w-full md:w-32 text-center mb-4 md:mb-0">
                                    <div class="text-xl md:text-2xl font-bold mb-1">28 NOV</div>
                                    <div class="text-base md:text-lg font-semibold text-emerald-200">2026</div>
                                </div>
                                <div
                                    class="flex-1 md:ml-6 md:pl-6 md:border-l-2 md:border-white/30 border-t-2 md:border-t-0 border-white/30 pt-4 md:pt-0 w-full text-center md:text-left">
                                    <h4 class="text-lg md:text-xl font-bold mb-2">Batas Akhir Pembayaran</h4>
                                    <p class="text-emerald-100/90 text-sm md:text-base">Batas akhir pembayaran biaya
                                        partisipasi
                                    </p>
                                </div>
                                <div class="absolute top-4 right-4 md:static md:ml-4">
                                    <div class="w-3 h-3 bg-teal-400 rounded-full"></div>
                                </div>
                            </div>

                            <div
                                class="flex flex-col md:flex-row items-center bg-white/10 backdrop-blur-sm rounded-2xl p-4 md:p-6 text-white hover-lift transition-all duration-300 hover:bg-emerald-500/15 relative">
                                <div class="flex-shrink-0 w-full md:w-32 text-center mb-4 md:mb-0">
                                    <div class="text-xl md:text-2xl font-bold mb-1">1-2 DES</div>
                                    <div class="text-base md:text-lg font-semibold text-emerald-200">2026</div>
                                </div>
                                <div
                                    class="flex-1 md:ml-6 md:pl-6 md:border-l-2 md:border-white/30 border-t-2 md:border-t-0 border-white/30 pt-4 md:pt-0 w-full text-center md:text-left">
                                    <h4 class="text-lg md:text-xl font-bold mb-2">Pelaksanaan Seminar Nasional</h4>
                                    <p class="text-emerald-100/90 text-sm md:text-base">Hari pelaksanaan seminar nasional
                                        STARNAS ASASI & ICoABCD
                                        2026</p>
                                </div>
                                <div class="absolute top-4 right-4 md:static md:ml-4">
                                    <div class="w-3 h-3 bg-amber-400 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-sm p-4 md:p-6 text-center border-t border-white/20">
                        <div class="flex flex-wrap justify-center items-center gap-4 md:gap-6 text-emerald-200">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-amber-400 rounded-full mr-2"></div>
                                <span class="text-sm">Pengumpulan</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-teal-300 rounded-full mr-2"></div>
                                <span class="text-sm">Review</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-emerald-400 rounded-full mr-2"></div>
                                <span class="text-sm">Pengumuman</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-teal-400 rounded-full mr-2"></div>
                                <span class="text-sm">Administrasi</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-400 rounded-full mr-2"></div>
                                <span class="text-sm">Acara</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mt-8 md:mt-12" data-aos="fade-up"
                data-aos-delay="400">
                <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 text-center hover-lift">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-exclamation-circle text-emerald-600 text-lg md:text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Penting!</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Pastikan untuk mematuhi semua deadline yang telah
                        ditetapkan
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 text-center hover-lift">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-teal-100 rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-check-circle text-teal-600 text-lg md:text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Konfirmasi</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Setelah mengirim, tunggu konfirmasi dari panitia</p>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-6 shadow-lg border border-gray-100 text-center hover-lift">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-question-circle text-amber-600 text-lg md:text-xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Bantuan?</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Hubungi panitia jika mengalami kendala teknis</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-12 md:py-20 bg-gradient-to-br from-slate-50 via-emerald-50/30 to-teal-50/20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <h2 class="text-2xl md:text-4xl font-bold text-slate-900 mb-4 md:mb-6">TENTANG STARNAS ASASI & ICoABCD 2026</h2>
                <p class="text-gray-600 text-base md:text-lg max-w-4xl mx-auto leading-relaxed">
                    Seminar Teknologi dan Sains Nasional Akademisi dan Saintis Indonesia:
                    <span class="font-semibold text-emerald-700">AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi</span>
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 md:gap-12 items-start justify-center">

                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="relative">
                        <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-200 group relative">
                            <img src="{{ asset('storage/brosur-starnas-2026.jpg') }}" alt="Poster Resmi STARNAS ASASI 2026 & ICoABCD 2026"
                                class="w-full h-auto object-contain transition-transform duration-500 group-hover:scale-[1.02]">
                        </div>

                        <div
                            class="absolute -bottom-4 -right-4 bg-gradient-to-r from-amber-500 to-orange-500 p-3 md:p-4 rounded-xl shadow-lg shadow-amber-500/30">
                            <div class="text-white text-center">
                                <div class="text-lg md:text-xl font-bold">1-2</div>
                                <div class="text-xs font-semibold">DESEMBER</div>
                                <div class="text-xs font-semibold">2026</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="300">
                    <div class="space-y-6 md:space-y-8">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 md:mb-6">Mengapa Anda Harus
                                Hadir?
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4 md:mb-6 text-sm md:text-base">
                                STARNAS ASASI & ICoABCD 2026 merupakan platform prestisius yang menghubungkan para akademisi, saintis,
                                praktisi, dan pembuat kebijakan untuk mendiskusikan inovasi kecerdasan buatan (AI) dalam mendukung
                                kemandirian ekonomi serta transisi energi berkelanjutan Indonesia.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <div
                                class="flex items-start p-4 bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300 h-full">
                                <div
                                    class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600 mr-3 md:mr-4 flex-shrink-0">
                                    <i class="fas fa-lightbulb text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Wawasan Terkini &
                                        Inovasi
                                    </h4>
                                    <p class="text-gray-600 text-xs md:text-sm">Dapatkan insight terbaru tentang tren
                                        AI, sains, dan teknologi masa depan dari para ahli terkemuka di bidangnya.</p>
                                </div>
                            </div>

                            <div
                                class="flex items-start p-4 bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300 h-full">
                                <div
                                    class="w-8 h-8 md:w-10 md:h-10 bg-amber-100 rounded-lg flex items-center justify-center text-amber-600 mr-3 md:mr-4 flex-shrink-0">
                                    <i class="fas fa-users text-sm md:text-base"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Networking Strategis
                                    </h4>
                                    <p class="text-gray-600 text-xs md:text-sm">Jaringan dengan akademisi, saintis, dan
                                        decision maker terkemuka dari berbagai institusi nasional maupun internasional.</p>
                                </div>
                            </div>

                            <div
                                class="flex flex-col items-center justify-center p-4 md:p-6 bg-white rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300 col-span-full h-full">

                                <div
                                    class="w-10 h-10 md:w-12 md:h-12 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 mb-3 flex-shrink-0">
                                    <i class="fas fa-handshake text-lg md:text-xl"></i>
                                </div>

                                <div class="text-center">
                                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Kolaborasi Riset
                                        Multidisiplin</h4>
                                    <p class="text-gray-600 text-xs md:text-sm max-w-md mx-auto">Temukan peluang
                                        kolaborasi riset dengan berbagai pemangku kepentingan untuk kemandirian ekonomi dan energi bangsa.</p>
                                </div>
                            </div>

                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 pt-4">
                            <a href="{{ route('register') }}"
                                class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-semibold py-3 px-4 md:px-6 rounded-lg text-center transition-all duration-300 shadow-lg shadow-emerald-500/25 hover:shadow-xl text-sm md:text-base">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Daftar Sekarang
                            </a>
                            <a href="#speakers"
                                class="flex-1 bg-white border-2 border-emerald-600 text-emerald-700 hover:bg-emerald-600 hover:text-white font-semibold py-3 px-4 md:px-6 rounded-lg text-center transition-all duration-300 shadow-md hover:shadow-xl text-sm md:text-base">
                                <i class="fas fa-users mr-2"></i>
                                Lihat Pembicara
                            </a>
                        </div>

                        <div class="bg-emerald-50/80 rounded-xl p-4 md:p-6 border-l-4 border-emerald-600 mt-6 md:mt-8">
                            <div class="flex items-start">
                                <div
                                    class="w-6 h-6 md:w-8 md:h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white mr-3 flex-shrink-0">
                                    <i class="fas fa-info-circle text-xs md:text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-emerald-950 mb-2 text-sm md:text-base">Informasi Acara</h4>
                                    <p class="text-emerald-900 text-xs md:text-sm">
                                        Acara ini akan diselenggarakan pada <span class="font-semibold text-emerald-950">1-2 Desember 2026</span>
                                        di <span class="font-semibold text-emerald-950">Grand Hotel De Djokja, Yogyakarta</span>. Jangan
                                        lewatkan kesempatan emas untuk menjadi bagian dari kemandirian ekonomi dan energi bangsa bersama kecerdasan buatan (AI).
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="download" class="py-12 md:py-16 bg-gradient-to-br from-emerald-50/50 via-teal-50/30 to-slate-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-8" data-aos="fade-up">
                <h3 class="text-xl md:text-3xl font-bold text-slate-900">Unduh Brosur Informasi Lengkap</h3>
                <p class="text-gray-600 max-w-xl mx-auto mt-2 text-sm md:text-base">
                    Dapatkan informasi detail mengenai Rakornas dan ICoABCD di sini.
                </p>
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-6 md:gap-8 max-w-4xl mx-auto">
                <a href="{{ asset('storage/rakornasbrosur.jpg') }}" download="Brosur_Rakornas_ASASI.jpg"
                    class="group flex-1 min-w-0 md:w-1/2 p-6 md:p-8 bg-white rounded-2xl shadow-xl border-t-4 border-emerald-600 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="100">

                    <div class="flex items-center space-x-4 md:space-x-6">
                        <div
                            class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16 bg-emerald-600 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-emerald-600/30">
                            <i class="fas fa-file-pdf text-white text-xl md:text-2xl"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-1">
                                Brosur <span class="text-emerald-600">Rakornas</span> ASASI
                            </h4>
                            <p class="text-sm text-gray-500">
                                Klik untuk Unduh Dokumen Lengkap Rakornas
                            </p>
                        </div>
                        <div
                            class="flex-shrink-0 text-emerald-600 text-xl md:text-2xl transform group-hover:translate-x-1 transition-transform duration-300">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ asset('storage/icoabcd-brosur.jpg') }}" download="Brosur_ICoABCD.jpg"
                    class="group flex-1 min-w-0 md:w-1/2 p-6 md:p-8 bg-white rounded-2xl shadow-xl border-t-4 border-amber-500 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="300">

                    <div class="flex items-center space-x-4 md:space-x-6">
                        <div
                            class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16 bg-amber-500 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-amber-500/30">
                            <i class="fas fa-book-open text-white text-xl md:text-2xl"></i>
                        </div>
                        <div class="flex-1 text-left">
                            <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-1">
                                Brosur <span class="text-amber-600">ICoABCD</span>
                            </h4>
                            <p class="text-sm text-gray-500">
                                Klik untuk Unduh Dokumen Lengkap ICoABCD
                            </p>
                        </div>
                        <div
                            class="flex-shrink-0 text-amber-500 text-xl md:text-2xl transform group-hover:translate-x-1 transition-transform duration-300">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="speakers" class="py-12 md:py-20 bg-gradient-to-br from-slate-50 via-teal-50/20 to-emerald-50/30">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <h2 class="text-2xl md:text-4xl font-bold text-slate-900 section-title">Pembicara Utama</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">Bertemu dengan para ahli dan praktisi
                    terkemuka yang akan berbagi pengetahuan dan pengalaman mereka.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="speaker-card rounded-2xl overflow-hidden h-full shadow-xl bg-white transition-all duration-300 hover:-translate-y-2 border border-emerald-500/10" data-aos="fade-up" data-aos-delay="100">
                    <div class="speaker-badge badge-keynote">KEYNOTE SPEAKER</div>
                    <div class="speaker-portrait overflow-hidden relative" style="height: 380px;">
                        <img src="/storage/yaser.jpeg" alt="Prof. Yasserly, Ph.D." class="w-full h-full object-cover object-top">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="speaker-name text-xl md:text-2xl font-bold text-gray-900 mb-1">Prof. Yasserly, Ph.D.</h3>
                        <p class="speaker-role text-sm md:text-base font-semibold text-emerald-600">Menteri Tenaga Kerja RI</p>
                        <p class="speaker-organization text-xs md:text-sm text-gray-500 mt-1">Kementerian Ketenagakerjaan RI</p>
                    </div>
                </div>

                <div class="speaker-card rounded-2xl overflow-hidden h-full shadow-xl bg-white transition-all duration-300 hover:-translate-y-2 border border-emerald-500/10" data-aos="fade-up" data-aos-delay="200">
                    <div class="speaker-badge badge-keynote">KEYNOTE SPEAKER</div>
                    <div class="speaker-portrait overflow-hidden relative" style="height: 380px;">
                        <img src="/storage/andi.jpeg" alt="Prof. Andy Adriansyah" class="w-full h-full object-cover object-top">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="speaker-name text-xl md:text-2xl font-bold text-gray-900 mb-1">Prof. Andy Adriansyah, Ph.D.</h3>
                        <p class="speaker-role text-sm md:text-base font-semibold text-emerald-600">Rektor Universitas Mercu Buana Jakarta</p>
                        <p class="speaker-organization text-xs md:text-sm text-gray-500 mt-1">Universitas Mercu Buana Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="biaya" class="py-12 md:py-20 bg-gradient-to-br from-slate-50 via-emerald-50/40 to-teal-50/30">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider mb-3">Registrasi & Investasi</span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 section-title">BIAYA PENDAFTARAN STARNAS ASASI & ICoABCD 2026</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-sm md:text-base mt-2">Informasi biaya pendaftaran untuk berbagai kategori peserta pemakalah dan non-presenter.</p>
            </div>

            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8 md:mb-12">
                    <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift price-card group border border-emerald-100 hover:border-emerald-400 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="benefit-icon bg-gradient-to-r from-emerald-600 to-teal-600 text-white mx-auto mb-3 md:mb-4 shadow-md shadow-emerald-500/20">
                            <i class="fas fa-user-tie text-lg md:text-xl"></i>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-2 md:mb-3">Anggota ASASI</h3>
                        <div class="text-xl md:text-2xl font-black text-emerald-600 mb-3 md:mb-4">Rp. 450.000,-</div>
                        <p class="text-slate-500 text-xs md:text-sm mb-3 md:mb-4">Khusus anggota aktif ASASI</p>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-lg transition-all duration-300 w-full block text-xs md:text-sm shadow-md shadow-emerald-600/20">
                            Daftar Sekarang
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift price-card group border border-emerald-100 hover:border-emerald-400 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="benefit-icon bg-gradient-to-r from-teal-600 to-emerald-700 text-white mx-auto mb-3 md:mb-4 shadow-md shadow-teal-500/20">
                            <i class="fas fa-users text-lg md:text-xl"></i>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-2 md:mb-3">Umum</h3>
                        <div class="text-xl md:text-2xl font-black text-emerald-600 mb-3 md:mb-4">Rp. 500.000,-</div>
                        <p class="text-slate-500 text-xs md:text-sm mb-3 md:mb-4">Untuk peserta umum</p>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-lg transition-all duration-300 w-full block text-xs md:text-sm shadow-md shadow-emerald-600/20">
                            Daftar Sekarang
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift price-card group border border-emerald-100 hover:border-emerald-400 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="benefit-icon bg-gradient-to-r from-teal-500 to-emerald-600 text-white mx-auto mb-3 md:mb-4 shadow-md shadow-teal-500/20">
                            <i class="fas fa-user-graduate text-lg md:text-xl"></i>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-2 md:mb-3">Mahasiswa</h3>
                        <div class="text-xl md:text-2xl font-black text-emerald-600 mb-3 md:mb-4">Rp. 250.000,-</div>
                        <p class="text-slate-500 text-xs md:text-sm mb-3 md:mb-4">Khusus mahasiswa aktif</p>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-lg transition-all duration-300 w-full block text-xs md:text-sm shadow-md shadow-emerald-600/20">
                            Daftar Sekarang
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 text-center hover-lift price-card group border border-emerald-100 hover:border-emerald-400 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="400">
                        <div
                            class="benefit-icon bg-gradient-to-r from-amber-500 to-amber-600 text-white mx-auto mb-3 md:mb-4 shadow-md shadow-amber-500/20">
                            <i class="fas fa-user text-lg md:text-xl"></i>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-2 md:mb-3">Non Presenter</h3>
                        <div class="text-xl md:text-2xl font-black text-emerald-600 mb-3 md:mb-4">Rp. 100.000,-</div>
                        <p class="text-slate-500 text-xs md:text-sm mb-3 md:mb-4">Peserta tanpa presentasi</p>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-semibold py-2 px-3 md:py-2 md:px-4 rounded-lg transition-all duration-300 w-full block text-xs md:text-sm shadow-md shadow-emerald-600/20">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>

                <div class="mt-8 md:mt-12" data-aos="fade-up">
                    <div class="bg-gradient-to-r from-slate-950 via-emerald-950 to-teal-950 rounded-2xl p-6 md:p-8 text-white shadow-2xl border border-emerald-500/30">
                        <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-center text-emerald-300">Benefit Peserta STARNAS ASASI 2026</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                            <div class="flex flex-col items-center text-center p-4 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/50 transition-all">
                                <i class="fas fa-certificate text-2xl md:text-3xl mb-2 md:mb-3 text-emerald-400"></i>
                                <h4 class="text-base md:text-lg font-bold mb-1 md:mb-2 text-white">e-Certificate</h4>
                                <p class="text-slate-300 text-xs md:text-sm">Sertifikat resmi berskala nasional untuk semua peserta terdaftar</p>
                            </div>
                            <div class="flex flex-col items-center text-center p-4 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/50 transition-all">
                                <i class="fas fa-trophy text-2xl md:text-3xl mb-2 md:mb-3 text-amber-400"></i>
                                <h4 class="text-base md:text-lg font-bold mb-1 md:mb-2 text-white">Best Paper & Presenter</h4>
                                <p class="text-slate-300 text-xs md:text-sm">Penghargaan prestisius untuk paper dan presenter terbaik</p>
                            </div>
                            <div class="flex flex-col items-center text-center p-4 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/50 transition-all">
                                <i class="fas fa-book text-2xl md:text-3xl mb-2 md:mb-3 text-teal-400"></i>
                                <h4 class="text-base md:text-lg font-bold mb-1 md:mb-2 text-white">Book Chapter ber-ISBN</h4>
                                <p class="text-slate-300 text-xs md:text-sm">Publikasi karya ilmiah dalam book chapter ber-ISBN</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 md:mt-8 bg-white rounded-2xl p-4 md:p-6 shadow-xl border border-emerald-100"
                    data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-lg md:text-xl font-bold text-slate-800 mb-3 md:mb-4 text-center">Informasi Penting</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 md:w-10 md:h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 mr-3 flex-shrink-0">
                                <i class="fas fa-info-circle text-sm md:text-base"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 mb-1 text-sm md:text-base">Kategori Pemakalah</h5>
                                <p class="text-slate-600 text-xs md:text-sm">Biaya berlaku untuk peserta yang mengirimkan makalah untuk dipresentasikan dalam sesi paralel.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 md:w-10 md:h-10 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mr-3 flex-shrink-0">
                                <i class="fas fa-user-check text-sm md:text-base"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-slate-800 mb-1 text-sm md:text-base">Non Presenter</h5>
                                <p class="text-slate-600 text-xs md:text-sm">Khusus peserta yang hanya mengikuti acara seminar nasional tanpa presentasi makalah.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION CO-HOST -->
    <section id="cohost" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-8 md:mb-16" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider mb-3">Kolaborasi Akademik</span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 section-title">CO-HOST & SPONSOR</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-sm md:text-base mt-2">
                    Diselenggarakan bersama dengan mitra universitas dan didukung oleh sponsor terkemuka.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 max-w-7xl mx-auto">
                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/logo-uts.png" alt="Universitas Teknologi Sumbawa" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/logo-lombok.png" alt="Lombok Institue Technology" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/sptn.png" alt="sptn" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/apji.png" alt="APJI" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/pinestilu.png" alt="Pinestilu" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="600">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/morikafe.png" alt="Morikafe" class="cohost-logo mx-auto">
                    </div>
                </div>
            </div>

            <div class="text-center mt-8 md:mt-12" data-aos="fade-up" data-aos-delay="800">
                <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 rounded-2xl p-4 md:p-6 border border-emerald-200 shadow-sm">
                    <h3 class="text-base md:text-xl font-bold text-emerald-900 mb-2 md:mb-3">Kolaborasi Strategis Nasional</h3>
                    <p class="text-slate-600 text-sm md:text-base max-w-2xl mx-auto">
                        Sinergi antara ASASI dengan mitra universitas dan asosiasi terkemuka Indonesia untuk menciptakan
                        dampak yang lebih besar dalam transformasi digital dan kemandirian bangsa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: MEDIA PARTNER -->
    <section id="media-partner" class="py-12 md:py-20 bg-gradient-to-br from-slate-50 via-emerald-50/20 to-slate-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-8 md:mb-16" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider mb-3">Publikasi & Liputan</span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 section-title">MEDIA PARTNER</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-sm md:text-base mt-2">
                    Didukung oleh mitra media terpercaya dalam penyebaran publikasi ilmiah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 max-w-3xl mx-auto">
                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/edutech.png" alt="Edutech" class="cohost-logo mx-auto">
                    </div>
                </div>

                <div class="cohost-card text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-slate-100 hover:border-emerald-300 hover:shadow-xl transition-all duration-300 flex items-center justify-center h-32 md:h-40">
                        <img src="/storage/edukator.webp" alt="Edukator" class="cohost-logo mx-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION LOKASI -->
    <section id="lokasi" class="py-12 md:py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold uppercase tracking-wider mb-3">Venue Penyelenggaraan</span>
                <h2 class="text-2xl md:text-4xl font-extrabold text-slate-900 section-title">LOKASI ACARA</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-sm md:text-base mt-2">STARNAS ASASI 2026 & ICoABCD 2026 akan diselenggarakan di Grand Hotel De Djokja, Yogyakarta.</p>
            </div>

            <div class="flex flex-col lg:flex-row items-center max-w-6xl mx-auto">
                <div class="lg:w-1/2 mb-8 md:mb-10 lg:mb-0 w-full" data-aos="fade-right">
                    <div class="rounded-3xl overflow-hidden shadow-2xl border-2 border-emerald-500/30 relative group h-full min-h-[360px] md:min-h-[420px] flex items-end">
                        <img src="{{ asset('storage/venue-djokja.jpg') }}" alt="Grand Hotel De Djokja Yogyakarta" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/50 to-transparent"></div>
                        <div class="relative z-10 p-6 md:p-8 text-white w-full">
                            <div class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white text-xs font-bold rounded-lg mb-2 shadow-md">
                                <i class="fas fa-hotel mr-1.5"></i> Grand Hotel De Djokja
                            </div>
                            <h3 class="text-2xl font-black mb-1 text-white">Grand Hotel De Djokja</h3>
                            <p class="text-emerald-200 text-xs md:text-sm">Venue Resmi STARNAS ASASI & ICoABCD 2026 • Kota Yogyakarta</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 lg:pl-8 md:lg:pl-12" data-aos="fade-left" data-aos-delay="300">
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-4 md:mb-6">Grand Hotel De Djokja Yogyakarta</h3>
                    <p class="text-slate-600 mb-4 md:mb-6 text-sm md:text-base leading-relaxed">Sebagai venue representatif di Yogyakarta, Grand Hotel De Djokja menyediakan fasilitas lengkap, ballroom representatif, dan akses strategis untuk mendukung kesuksesan STARNAS ASASI 2026 & ICoABCD 2026.</p>

                    <div class="space-y-3 md:space-y-4 mb-6 md:mb-8">
                        <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div
                                class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 mr-3 md:mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-base"></i>
                            </div>
                            <div>
                                <p class="text-slate-800 text-sm md:text-base font-medium">Grand Hotel De Djokja, Kota Yogyakarta, D.I. Yogyakarta</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div
                                class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 mr-3 md:mr-4 flex-shrink-0">
                                <i class="fas fa-hotel text-base"></i>
                            </div>
                            <div>
                                <p class="text-slate-800 text-sm md:text-base">Convention hall & ballroom modern berkapasitas besar</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div
                                class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-700 mr-3 md:mr-4 flex-shrink-0">
                                <i class="fas fa-wifi text-base"></i>
                            </div>
                            <div>
                                <p class="text-slate-800 text-sm md:text-base">Konektivitas internet dedicated & hybrid conference system</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-xl bg-emerald-50/70 border border-emerald-100">
                            <div
                                class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white mr-3 md:mr-4 flex-shrink-0 shadow-md shadow-emerald-600/30">
                                <i class="fas fa-calendar-check text-base"></i>
                            </div>
                            <div>
                                <p class="text-emerald-900 text-sm md:text-base font-bold">1 - 2 Desember 2026</p>
                            </div>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=Grand+Hotel+De+Djokja" target="_blank"
                        class="inline-flex items-center bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-500 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 hover-lift text-sm md:text-base shadow-lg shadow-emerald-600/25">
                        <i class="fas fa-map-marked-alt mr-2"></i>
                        <span>Buka Petunjuk Arah Google Maps</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection