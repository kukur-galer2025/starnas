@extends('peserta.layouts.app')

@section('content')
<div class="content-padding pt-24">
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-16 md:py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md border border-emerald-400/30 text-emerald-200 mb-4">
                    <i class="fas fa-calendar-alt mr-2 text-amber-300"></i> Tentative Schedule
                </span>
                <h1 class="text-3xl md:text-5xl font-black mb-3 leading-tight" data-aos="fade-up">
                    RUNDOWN STARNAS ASASI 2026 & ICoABCD 2026
                </h1>
                <p class="text-base md:text-xl text-emerald-100/90 mb-4 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <span class="font-bold text-amber-300">Tema:</span> AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi
                </p>

                <div class="flex flex-wrap justify-center items-center gap-3 md:gap-6 mt-6 text-sm" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-2 bg-emerald-950/40 px-4 py-2 rounded-xl border border-emerald-500/30 backdrop-blur-sm">
                        <i class="fas fa-calendar-day text-amber-400"></i>
                        <span class="font-semibold">01 - 02 Desember 2026</span>
                    </div>
                    <div class="flex items-center gap-2 bg-emerald-950/40 px-4 py-2 rounded-xl border border-emerald-500/30 backdrop-blur-sm">
                        <i class="fas fa-map-marker-alt text-amber-400"></i>
                        <span class="font-semibold">Grand Hotel De Djokja, Yogyakarta</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 bg-black/25"></div>
    </section>

    <!-- Keynote Spotlight Banner -->
    <section class="py-8 bg-gradient-to-r from-emerald-950 via-slate-900 to-teal-950 border-b border-emerald-500/20 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center justify-center md:justify-start gap-2 mb-1">
                            <i class="fas fa-star text-amber-400"></i> Pembicara Utama (Keynote Speech)
                        </span>
                        <h3 class="text-lg md:text-xl font-extrabold text-white">Plenary Keynote Session (Hari ke-2: 09.30 – 12.00)</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full md:w-auto">
                        <div class="flex items-center gap-3 bg-white/5 border border-emerald-400/20 p-3 rounded-xl backdrop-blur-sm">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 font-bold flex-shrink-0 shadow">
                                1
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-sm text-white leading-snug">Prof. Yasserly, Ph.D.</h4>
                                <p class="text-xs text-emerald-300">Menteri Tenaga Kerja RI</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-white/5 border border-emerald-400/20 p-3 rounded-xl backdrop-blur-sm">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center text-white font-bold flex-shrink-0 shadow">
                                2
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold text-sm text-white leading-snug">Prof. Andy Adriansyah, Ph.D.</h4>
                                <p class="text-xs text-emerald-300">Rektor Universitas Mercu Buana Jakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rundown Content -->
    <section class="py-12 md:py-16 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- Filter Tabs -->
                <div class="flex justify-center mb-10" data-aos="fade-up">
                    <div class="inline-flex p-1.5 bg-white rounded-2xl shadow-md border border-emerald-100 gap-1.5">
                        <button type="button" onclick="filterDay('all')" id="tab-all"
                            class="day-tab px-4 md:px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all duration-300 bg-emerald-600 text-white shadow-sm">
                            <i class="fas fa-layer-group mr-1.5"></i> Semua Hari
                        </button>
                        <button type="button" onclick="filterDay('day1')" id="tab-day1"
                            class="day-tab px-4 md:px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all duration-300 text-slate-600 hover:text-emerald-700 hover:bg-emerald-50">
                            <i class="fas fa-calendar-day mr-1.5"></i> Hari 1 (Selasa, 1 Des)
                        </button>
                        <button type="button" onclick="filterDay('day2')" id="tab-day2"
                            class="day-tab px-4 md:px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all duration-300 text-slate-600 hover:text-emerald-700 hover:bg-emerald-50">
                            <i class="fas fa-calendar-day mr-1.5"></i> Hari 2 (Rabu, 2 Des)
                        </button>
                    </div>
                </div>

                <!-- ================= HARI PERTAMA ================= -->
                <div id="section-day1" class="day-section mb-14" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-emerald-600">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center text-white font-black shadow-md">
                            1
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">HARI PERTAMA</h2>
                            <p class="text-xs md:text-sm font-semibold text-emerald-700 flex items-center gap-2">
                                <i class="fas fa-calendar-alt"></i> Selasa, 1 Desember 2026 • Grand Hotel De Djokja
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Sesi 1: Pembukaan -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    09.00 – 09.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Pembukaan Hari Pertama</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-welcoming-session">Pembukaan</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: Tim ICoABCD
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-3">Upacara pembukaan resmi konferensi dan seminar gabungan STARNAS ASASI & ICoABCD 2026.</p>
                                    <ul class="space-y-1.5 text-xs md:text-sm text-slate-700 bg-emerald-50/50 p-3 rounded-xl border border-emerald-100">
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                                            <span>Menyanyikan lagu kebangsaan <strong>Indonesia Raya</strong></span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                                            <span>Sambutan Ketua Umum ASASI</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-emerald-600 text-xs"></i>
                                            <span>Pembacaan Doa</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 2: Plenary Session 1 -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    09.30 – 12.00
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Plenary Session 1</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-keynote-session">Plenary</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: Tim ICoABCD
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600">Sesi pleno internasional ICoABCD sesi pertama yang menghadirkan narasumber utama untuk memaparkan topik perkembangan frontier technology terkini.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 3: Isoma -->
                        <div class="timeline-item bg-slate-50/90 rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="session-time bg-slate-200 text-slate-700 py-2 px-4 rounded-xl font-bold text-center min-w-[130px] flex-shrink-0">
                                    12.00 – 13.00
                                </div>
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-800">Isoma (Istirahat, Sholat, Makan)</h3>
                                        <p class="text-xs text-slate-500">Istirahat makan siang dan ibadah sholat Dzuhur.</p>
                                    </div>
                                    <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 4: Parallel Session IcoABCD dan SOFTT -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-teal-100 text-teal-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    13.00 – 15.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Parallel Session ICoABCD dan SOFTT</h3>
                                        <span class="session-badge badge-parallel-session">Parallel</span>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600">Sesi presentasi paralel paper riset internasional konferensi ICoABCD dan School of Frontier Technology (SOFTT) yang terbagi di beberapa ruangan breakout.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 5: Isoma Ashar -->
                        <div class="timeline-item bg-slate-50/90 rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="session-time bg-slate-200 text-slate-700 py-2 px-4 rounded-xl font-bold text-center min-w-[130px] flex-shrink-0">
                                    15.30 – 16.00
                                </div>
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-800">Isoma (Coffee Break & Sholat Ashar)</h3>
                                        <p class="text-xs text-slate-500">Rehat sore, coffee break, dan sholat Ashar.</p>
                                    </div>
                                    <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 6: Parallel Session STARNAS ASASI -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    16.00 – 17.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Parallel Session STARNAS ASASI</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-parallel-session">Parallel</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: A Zaki, Feri, Dito
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-2">Presentasi paralel makalah nasional STARNAS ASASI 2026 serta lanjutan Parallel Session ICoABCD dan SOFTT.</p>
                                    <div class="flex flex-wrap gap-2 text-xs">
                                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-800 rounded-lg border border-emerald-200 font-medium">Sesi Pemakalah STARNAS ASASI</span>
                                        <span class="px-2.5 py-1 bg-teal-50 text-teal-800 rounded-lg border border-teal-200 font-medium">Lanjutan Parallel ICoABCD & SOFTT</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 7: Isoma Malam -->
                        <div class="timeline-item bg-slate-50/90 rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="session-time bg-slate-200 text-slate-700 py-2 px-4 rounded-xl font-bold text-center min-w-[130px] flex-shrink-0">
                                    17.30 – 19.00
                                </div>
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-800">Isoma (Makan Malam & Sholat Maghrib / Isya)</h3>
                                        <p class="text-xs text-slate-500">Makan malam bersama dan istirahat ibadah.</p>
                                    </div>
                                    <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 8: Sesi Malam Multi-Agenda -->
                        <div class="timeline-item bg-gradient-to-br from-white to-emerald-50/40 rounded-2xl p-5 md:p-6 shadow-md border-2 border-emerald-500/30">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-700 text-white py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow">
                                    19.00 – 22.00
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                        <h3 class="text-base md:text-lg font-black text-slate-900">Sesi Malam: STARNAS, RAKORNAS & RAKOR SPTI</h3>
                                        <span class="session-badge badge-special-session">Sesi Paralel & Sidang</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <!-- Sub-agenda a -->
                                        <div class="bg-white p-3.5 rounded-xl border border-emerald-200/80 shadow-sm">
                                            <div class="text-[11px] font-bold text-emerald-800 uppercase mb-1">
                                                <i class="fas fa-microphone mr-1"></i> Agenda A
                                            </div>
                                            <h4 class="font-bold text-sm text-slate-900 mb-1">Lanjutan Parallel Session STARNAS ASASI</h4>
                                            <p class="text-xs text-slate-500 mb-2">Presentasi makalah riset nasional sesi malam.</p>
                                            <div class="text-[11px] font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded inline-block">
                                                PIC: A Zaki, Feri, Dito
                                            </div>
                                        </div>

                                        <!-- Sub-agenda b -->
                                        <div class="bg-white p-3.5 rounded-xl border border-amber-300 shadow-sm">
                                            <div class="text-[11px] font-bold text-amber-800 uppercase mb-1">
                                                <i class="fas fa-users-cog mr-1"></i> Agenda B
                                            </div>
                                            <h4 class="font-bold text-sm text-slate-900 mb-1">Rakornas ASASI</h4>
                                            <p class="text-xs text-slate-500 mb-2">Rapat Koordinasi Nasional Perkumpulan ASASI.</p>
                                            <div class="text-[11px] font-bold text-amber-900 bg-amber-100 px-2 py-0.5 rounded inline-block">
                                                PIC: Khair, Ferial
                                            </div>
                                        </div>

                                        <!-- Sub-agenda c -->
                                        <div class="bg-white p-3.5 rounded-xl border border-teal-200 shadow-sm">
                                            <div class="text-[11px] font-bold text-teal-800 uppercase mb-1">
                                                <i class="fas fa-handshake mr-1"></i> Agenda C
                                            </div>
                                            <h4 class="font-bold text-sm text-slate-900 mb-1">Rakor SPTI</h4>
                                            <p class="text-xs text-slate-500 mb-2">Rapat Koordinasi Sekolah & Perguruan Tinggi Informatika.</p>
                                            <div class="text-[11px] font-bold text-teal-900 bg-teal-100 px-2 py-0.5 rounded inline-block">
                                                PIC: Dr. Mujidin
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= HARI KEDUA ================= -->
                <div id="section-day2" class="day-section mb-14" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-amber-500">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-black shadow-md">
                            2
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">HARI KEDUA</h2>
                            <p class="text-xs md:text-sm font-semibold text-amber-700 flex items-center gap-2">
                                <i class="fas fa-calendar-alt"></i> Rabu, 2 Desember 2026 • Grand Hotel De Djokja
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Sesi 1: Pembukaan Hari Kedua -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-amber-100 text-amber-900 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    08.30 – 09.00
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Pembukaan Hari Kedua</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-welcoming-session">Pembukaan</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: Tim ICoABCD
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-3">Pembukaan sesi hari kedua konferensi dan seminar nasional.</p>
                                    <ul class="space-y-1.5 text-xs md:text-sm text-slate-700 bg-amber-50/50 p-3 rounded-xl border border-amber-200">
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Menyanyikan lagu kebangsaan <strong>Indonesia Raya</strong></span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Menyanyikan lagu <strong>Mars ASASI</strong></span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Sambutan Ketua Umum ASASI</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 2: Plenary Session Keynote Speakers -->
                        <div class="timeline-item bg-gradient-to-br from-white via-emerald-50/30 to-amber-50/30 rounded-2xl p-5 md:p-6 shadow-md border-2 border-emerald-500/40">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2.5 px-4 rounded-xl font-black text-center min-w-[130px] flex-shrink-0 shadow">
                                    09.30 – 12.00
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-xl font-black text-slate-900">Plenary Session (Keynote Speech)</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-keynote-session">Keynote Speech</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-white text-slate-700 border border-slate-200 shadow-sm">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: Tim ICoABCD
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-4">Pemaparan materi utama dari para tokoh dan pakar nasional terkemuka:</p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Keynote 1 -->
                                        <div class="bg-white p-4 rounded-xl border border-emerald-200 shadow-sm flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-amber-500 text-slate-950 font-black flex items-center justify-center flex-shrink-0 text-sm shadow">
                                                A
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-sm md:text-base text-slate-900">Prof. Yasserly, Ph.D.</h4>
                                                <p class="text-xs font-semibold text-emerald-700 mb-1">Menteri Tenaga Kerja RI</p>
                                                <p class="text-xs text-slate-500 leading-relaxed">Strategi implementasi AI dalam memberdayakan tenaga kerja terampil menuju kemandirian ekonomi dan energi nasional.</p>
                                            </div>
                                        </div>

                                        <!-- Keynote 2 -->
                                        <div class="bg-white p-4 rounded-xl border border-teal-200 shadow-sm flex items-start gap-3">
                                            <div class="w-9 h-9 rounded-lg bg-teal-600 text-white font-black flex items-center justify-center flex-shrink-0 text-sm shadow">
                                                B
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-sm md:text-base text-slate-900">Prof. Andy Adriansyah, Ph.D.</h4>
                                                <p class="text-xs font-semibold text-emerald-700 mb-1">Rektor Universitas Mercu Buana Jakarta</p>
                                                <p class="text-xs text-slate-500 leading-relaxed">Pemanfaatan kecerdasan buatan, robotika, dan teknologi cerdas untuk ketahanan industri dan kemandirian bangsa.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 3: Isoma -->
                        <div class="timeline-item bg-slate-50/90 rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="session-time bg-slate-200 text-slate-700 py-2 px-4 rounded-xl font-bold text-center min-w-[130px] flex-shrink-0">
                                    12.00 – 13.00
                                </div>
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-800">Isoma (Istirahat, Sholat, Makan)</h3>
                                        <p class="text-xs text-slate-500">Makan siang dan sholat Dzuhur berjamaah.</p>
                                    </div>
                                    <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 4: 5 Track Parallel Sessions -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-teal-100 text-teal-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    13.00 – 15.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Sesi Paralel Multi-Track (5 Sesi)</h3>
                                        <span class="session-badge badge-parallel-session">Multi-Track</span>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-3">Pelaksanaan serentak sesi paralel konferensi internasional, seminar nasional, dan rapat kerja organisasi:</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                                            <span class="font-bold text-emerald-800 block mb-0.5">a. Parallel Session ICoABCD</span>
                                            <span class="text-slate-500">Presentasi paper internasional bidang AI, Cloud & Data.</span>
                                        </div>
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                                            <span class="font-bold text-teal-800 block mb-0.5">b. Parallel Session SOFTT</span>
                                            <span class="text-slate-500">School of Frontier Technology conference track.</span>
                                        </div>
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                                            <span class="font-bold text-emerald-800 block mb-0.5">c. Parallel Session STARNAS</span>
                                            <span class="text-slate-500">Presentasi pemakalah riset sains & teknologi nasional.</span>
                                        </div>
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                                            <span class="font-bold text-amber-800 block mb-0.5">d. Rakornas ASASI</span>
                                            <span class="text-slate-500">Sidang pleno perumusan program kerja tahunan ASASI.</span>
                                        </div>
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs sm:col-span-2 lg:col-span-1">
                                            <span class="font-bold text-teal-800 block mb-0.5">e. Rakor SPTI</span>
                                            <span class="text-slate-500">Sesi koordinasi kurikulum & riset perguruan tinggi informatika.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 5: Isoma Ashar -->
                        <div class="timeline-item bg-slate-50/90 rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-center gap-4">
                                <div class="session-time bg-slate-200 text-slate-700 py-2 px-4 rounded-xl font-bold text-center min-w-[130px] flex-shrink-0">
                                    15.30 – 16.00
                                </div>
                                <div class="flex-1 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm md:text-base font-bold text-slate-800">Isoma (Coffee Break & Sholat Ashar)</h3>
                                        <p class="text-xs text-slate-500">Coffee break dan istirahat sholat Ashar.</p>
                                    </div>
                                    <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi 6: Lanjutan & Penutupan -->
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200/80">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0 shadow-sm">
                                    16.00 – 17.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Lanjutan Parallel Session & Penutupan Acara</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-welcoming-session">Penutupan</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-tag text-emerald-600 mr-1"></i> PIC: A Zaki, Feri, Dito
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-2">Lanjutan sesi paralel ICoABCD, SOFTT, STARNAS ASASI, Rakornas ASASI, dan Rakor SPTI, dilanjutkan upacara penutupan resmi konferensi dan penyerahan penghargaan.</p>
                                    <div class="p-3 bg-emerald-50 rounded-xl border border-emerald-100 text-xs text-emerald-950 font-medium">
                                        <i class="fas fa-award text-amber-500 mr-1"></i> Pengumuman Best Paper, Best Presenter, kesimpulan Rakornas ASASI, dan penutupan seluruh rangkaian acara.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="p-6 bg-gradient-to-r from-emerald-50/70 via-teal-50/50 to-emerald-100/40 rounded-2xl border border-emerald-200 mb-8" data-aos="fade-up">
                    <h3 class="text-base font-bold text-slate-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-tags text-emerald-700"></i> Keterangan Kategori Sesi:
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        <div class="flex items-center gap-2">
                            <span class="session-badge badge-keynote-session">Plenary</span>
                            <span class="text-xs text-slate-600">Sesi Utama</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="session-badge badge-welcoming-session">Seremonial</span>
                            <span class="text-xs text-slate-600">Pembukaan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="session-badge badge-parallel-session">Paralel</span>
                            <span class="text-xs text-slate-600">Presentasi Paper</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="session-badge badge-special-session">Sidang</span>
                            <span class="text-xs text-slate-600">Rakornas / SPTI</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="session-badge bg-slate-200 text-slate-700">Break</span>
                            <span class="text-xs text-slate-600">Isoma</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-amber-50/80 border border-amber-200/80 rounded-2xl p-6" data-aos="fade-up">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-bold flex-shrink-0 shadow-sm mt-0.5">
                            <i class="fas fa-info-circle text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-base mb-2">Informasi Penting Peserta:</h4>
                            <ul class="text-xs md:text-sm text-slate-700 space-y-2">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-clock text-amber-600 mt-1 flex-shrink-0"></i>
                                    <span>Peserta diharapkan hadir 15 menit sebelum setiap sesi dimulai untuk registrasi kehadiran di meja panitia.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-user-tie text-amber-600 mt-1 flex-shrink-0"></i>
                                    <span><strong>Dress Code:</strong> Pakaian formal / batik nasional untuk seluruh rangkaian acara seminar dan sidang pleno.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-laptop text-amber-600 mt-1 flex-shrink-0"></i>
                                    <span>Presenter sesi paralel diharapkan telah menyerahkan file presentasi (PPT / PDF) kepada panitia sebelum sesi paralel dimulai.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt text-amber-600 mt-1 flex-shrink-0"></i>
                                    <span>Venue penyelenggaraan berada di <strong>Grand Hotel De Djokja, Yogyakarta</strong>. WiFi & fasilitas multimedia representatif telah disiapkan panitia.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    function filterDay(day) {
        const secDay1 = document.getElementById('section-day1');
        const secDay2 = document.getElementById('section-day2');
        const tabs = document.querySelectorAll('.day-tab');

        tabs.forEach(tab => {
            tab.classList.remove('bg-emerald-600', 'text-white', 'shadow-sm');
            tab.classList.add('text-slate-600');
        });

        const activeTab = document.getElementById('tab-' + day);
        if (activeTab) {
            activeTab.classList.remove('text-slate-600');
            activeTab.classList.add('bg-emerald-600', 'text-white', 'shadow-sm');
        }

        if (day === 'day1') {
            secDay1.style.display = 'block';
            secDay2.style.display = 'none';
        } else if (day === 'day2') {
            secDay1.style.display = 'none';
            secDay2.style.display = 'block';
        } else {
            secDay1.style.display = 'block';
            secDay2.style.display = 'block';
        }
    }
</script>
@endsection