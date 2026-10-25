@extends('peserta.layouts.app')

@section('content')
<div class="content-padding pt-24">
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-16 md:py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md border border-amber-400/30 text-amber-200 mb-4">
                    <i class="fas fa-users-cog mr-2 text-amber-300"></i> Rapat Koordinasi Nasional
                </span>
                <h1 class="text-3xl md:text-5xl font-black mb-3 leading-tight" data-aos="fade-up">
                    RUNDOWN RAKORNAS ASASI 2026
                </h1>
                <p class="text-base md:text-xl text-emerald-100/90 mb-4 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Rapat Koordinasi Nasional Perkumpulan Akademisi dan Saintis Indonesia (ASASI)
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
                    <div class="flex items-center gap-2 bg-emerald-950/40 px-4 py-2 rounded-xl border border-emerald-500/30 backdrop-blur-sm">
                        <i class="fas fa-user-shield text-amber-400"></i>
                        <span class="font-semibold">PIC: Khair, Ferial</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 bg-black/25"></div>
    </section>

    <!-- Content Section -->
    <section class="py-12 md:py-16 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- Alert Navigasi -->
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up">
                    <div class="flex items-center gap-3 text-emerald-900 text-xs md:text-sm">
                        <i class="fas fa-info-circle text-emerald-600 text-lg"></i>
                        <span>RAKORNAS ASASI diselenggarakan terintegrasi bersama agenda STARNAS ASASI & ICoABCD 2026.</span>
                    </div>
                    <a href="{{ route('rundown.starnas') }}"
                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition shadow flex items-center gap-2 flex-shrink-0">
                        <i class="fas fa-list-alt"></i> Lihat Rundown Lengkap
                    </a>
                </div>

                <!-- Timeline Hari 1 -->
                <div class="mb-12" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-emerald-600">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center text-white font-black shadow-md">
                            1
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">HARI PERTAMA: SIDANG PLENO I</h2>
                            <p class="text-xs md:text-sm font-semibold text-emerald-700">Selasa, 1 Desember 2026 • Grand Hotel De Djokja</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0">
                                    09.00 – 12.00
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-bold text-slate-900 mb-1">Pembukaan Bersama & Plenary Session 1</h3>
                                    <p class="text-xs md:text-sm text-slate-600 mb-2">Delegasi RAKORNAS menghadiri upacara pembukaan bersama STARNAS & ICoABCD serta sesi pleno internasional.</p>
                                    <span class="session-badge badge-welcoming-session">Pleno Gabungan</span>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item bg-gradient-to-br from-white to-amber-50/40 rounded-2xl p-5 md:p-6 shadow-md border-2 border-amber-400">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-amber-500 text-slate-950 py-2.5 px-4 rounded-xl font-black text-center min-w-[130px] flex-shrink-0 shadow">
                                    19.00 – 22.00
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-black text-slate-900">Sidang Pleno I RAKORNAS ASASI 2026</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-special-session">Sidang Utama</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-900 border border-amber-200">
                                                <i class="fas fa-user-shield text-amber-700 mr-1"></i> PIC: Khair, Ferial
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-3">Sesi sidang koordinasi nasional pengurus pusat dan dewan perwakilan wilayah ASASI seluruh Indonesia.</p>
                                    <ul class="space-y-1.5 text-xs md:text-sm text-slate-700 bg-white p-3 rounded-xl border border-amber-200">
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Evaluasi Program Kerja Tahunan dan Capaian Organisasi ASASI</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Pemaparan Inisiatif Riset Terpadu & Roadmap Sains Nasional 2026-2030</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <i class="fas fa-check-circle text-amber-600 text-xs"></i>
                                            <span>Koordinasi Dewan Pakar Regional & Pembentukan Pokja Riset Strategis</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Hari 2 -->
                <div class="mb-12" data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-6 pb-3 border-b-2 border-amber-500">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center text-slate-950 font-black shadow-md">
                            2
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-slate-900">HARI KEDUA: SIDANG KOMISI & PENETAPAN HASIL</h2>
                            <p class="text-xs md:text-sm font-semibold text-amber-700">Rabu, 2 Desember 2026 • Grand Hotel De Djokja</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0">
                                    09.30 – 12.00
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-base font-bold text-slate-900 mb-1">Plenary Session Keynote Speech</h3>
                                    <p class="text-xs md:text-sm text-slate-600 mb-2">Delegasi RAKORNAS mengikuti kuliah umum pembicara utama Menteri Tenaga Kerja RI (Prof. Yasserly, Ph.D.) dan Rektor UMB (Prof. Andy Adriansyah, Ph.D.).</p>
                                    <span class="session-badge badge-keynote-session">Kuliah Utama</span>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item bg-gradient-to-br from-white to-emerald-50/40 rounded-2xl p-5 md:p-6 shadow-md border-2 border-emerald-500/40">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-teal-600 text-white py-2.5 px-4 rounded-xl font-black text-center min-w-[130px] flex-shrink-0 shadow">
                                    13.00 – 15.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-black text-slate-900">Sidang Komisi RAKORNAS ASASI</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="session-badge badge-parallel-session">Sidang Komisi</span>
                                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                <i class="fas fa-user-shield text-emerald-600 mr-1"></i> PIC: Khair, Ferial
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600 mb-3">Pembahasan terfokus dalam komisi-komisi kerja ASASI:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5 text-xs">
                                        <div class="p-3 bg-white rounded-xl border border-slate-200">
                                            <strong class="text-emerald-800 block mb-1">Komisi A: Organisasi</strong>
                                            <p class="text-slate-500">Tata kelola, keanggotaan wilayah, dan kaderisasi saintis.</p>
                                        </div>
                                        <div class="p-3 bg-white rounded-xl border border-slate-200">
                                            <strong class="text-teal-800 block mb-1">Komisi B: Riset & Jurnal</strong>
                                            <p class="text-slate-500">Penguatan indeksasi jurnal ASASI, hibah riset, dan publikasi.</p>
                                        </div>
                                        <div class="p-3 bg-white rounded-xl border border-slate-200">
                                            <strong class="text-amber-800 block mb-1">Komisi C: Kemitraan</strong>
                                            <p class="text-slate-500">Kerjasama industri, pemerintah, dan hilirisasi inovasi AI.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-item bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-slate-200">
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="session-time bg-emerald-100 text-emerald-800 py-2.5 px-4 rounded-xl font-extrabold text-center min-w-[130px] flex-shrink-0">
                                    16.00 – 17.30
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <h3 class="text-base md:text-lg font-bold text-slate-900">Pleno Penetapan Rekomendasi & Penutupan</h3>
                                        <span class="session-badge badge-welcoming-session">Penetapan Hasil</span>
                                    </div>
                                    <p class="text-xs md:text-sm text-slate-600">Sidang pleno pengesahan hasil rekomendasi komisi RAKORNAS ASASI 2026, penandatanganan kesepahaman, dan penutupan resmi seluruh rangkaian kegiatan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection