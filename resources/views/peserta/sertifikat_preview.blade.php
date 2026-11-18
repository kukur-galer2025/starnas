<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat STARNAS ASASI & ICoABCD 2026 - {{ $nama_peserta ?? 'Peserta' }}</title>
    
    <!-- Favicon / Ikon Web STARNAS -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        @page { size: A4 landscape; margin: 0; }
        
        .font-luxury { font-family: 'Cinzel', serif; } 
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-body { font-family: 'Montserrat', sans-serif; }
        .font-serif-classic { font-family: 'Playfair Display', serif; }

        /* ===== PALET TEMA 1: ROYAL EMERALD 2026 (DEFAULT BARU) ===== */
        .theme-emerald-2026 .bg-pattern {
            background-color: #fbfdfc; 
            background-image: 
                radial-gradient(circle at 100% 50%, transparent 20%, rgba(5, 150, 105, 0.035) 21%, rgba(5, 150, 105, 0.035) 34%, transparent 35%, transparent),
                radial-gradient(circle at 0% 50%, transparent 20%, rgba(13, 148, 136, 0.035) 21%, rgba(13, 148, 136, 0.035) 34%, transparent 35%, transparent);
            background-size: 100px 100px;
        }
        .theme-emerald-2026 .cert-border-outer { border-color: #047857; }
        .theme-emerald-2026 .cert-border-inner { border-color: #0d9488; }
        .theme-emerald-2026 .cert-corner { color: #047857; }
        .theme-emerald-2026 .cert-watermark-seal { border-color: #059669; }
        .theme-emerald-2026 .cert-watermark-text { color: #064e3b; }
        .theme-emerald-2026 .cert-logo-divider { border-color: rgba(5, 150, 105, 0.35); }
        .theme-emerald-2026 .cert-title-gradient {
            background: linear-gradient(135deg, #064e3b 0%, #047857 28%, #0d9488 50%, #047857 75%, #064e3b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: #047857;
            text-shadow: 0px 1px 2px rgba(6, 78, 59, 0.15);
        }
        .theme-emerald-2026 .cert-accent-line {
            background: linear-gradient(to right, transparent, #047857);
        }
        .theme-emerald-2026 .cert-accent-line-rev {
            background: linear-gradient(to left, transparent, #047857);
        }
        .theme-emerald-2026 .cert-event-title { color: #047857; }
        .theme-emerald-2026 .cert-serial-num { color: #065f46; }
        .theme-emerald-2026 .cert-theme-box {
            border-color: #a7f3d0;
            background-color: rgba(236, 253, 245, 0.6);
        }

        /* ===== PALET TEMA 2: SAPPHIRE NAVY 2026 ===== */
        .theme-sapphire-2026 .bg-pattern {
            background-color: #f8fafc; 
            background-image: 
                radial-gradient(circle at 100% 50%, transparent 20%, rgba(30, 58, 138, 0.035) 21%, rgba(30, 58, 138, 0.035) 34%, transparent 35%, transparent),
                radial-gradient(circle at 0% 50%, transparent 20%, rgba(14, 165, 233, 0.035) 21%, rgba(14, 165, 233, 0.035) 34%, transparent 35%, transparent);
            background-size: 100px 100px;
        }
        .theme-sapphire-2026 .cert-border-outer { border-color: #1e3a8a; }
        .theme-sapphire-2026 .cert-border-inner { border-color: #0284c7; }
        .theme-sapphire-2026 .cert-corner { color: #1e3a8a; }
        .theme-sapphire-2026 .cert-watermark-seal { border-color: #1e40af; }
        .theme-sapphire-2026 .cert-watermark-text { color: #1e3a8a; }
        .theme-sapphire-2026 .cert-logo-divider { border-color: rgba(30, 58, 138, 0.35); }
        .theme-sapphire-2026 .cert-title-gradient {
            background: linear-gradient(135deg, #172554 0%, #1e3a8a 30%, #0284c7 52%, #1e3a8a 75%, #172554 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: #1e3a8a;
            text-shadow: 0px 1px 2px rgba(30, 58, 138, 0.15);
        }
        .theme-sapphire-2026 .cert-accent-line {
            background: linear-gradient(to right, transparent, #1e3a8a);
        }
        .theme-sapphire-2026 .cert-accent-line-rev {
            background: linear-gradient(to left, transparent, #1e3a8a);
        }
        .theme-sapphire-2026 .cert-event-title { color: #1e3a8a; }
        .theme-sapphire-2026 .cert-serial-num { color: #1e40af; }
        .theme-sapphire-2026 .cert-theme-box {
            border-color: #bae6fd;
            background-color: rgba(240, 249, 255, 0.6);
        }

        /* ===== PALET TEMA 3: CLASSIC GOLD (TAHUN LALU) ===== */
        .theme-gold-classic .bg-pattern {
            background-color: #fffaf0; 
            background-image: 
                radial-gradient(circle at 100% 50%, transparent 20%, rgba(184, 134, 11, 0.03) 21%, rgba(184, 134, 11, 0.03) 34%, transparent 35%, transparent),
                radial-gradient(circle at 0% 50%, transparent 20%, rgba(184, 134, 11, 0.03) 21%, rgba(184, 134, 11, 0.03) 34%, transparent 35%, transparent);
            background-size: 100px 100px;
        }
        .theme-gold-classic .cert-border-outer { border-color: #b8860b; }
        .theme-gold-classic .cert-border-inner { border-color: #002147; }
        .theme-gold-classic .cert-corner { color: #b8860b; }
        .theme-gold-classic .cert-watermark-seal { border-color: #b8860b; }
        .theme-gold-classic .cert-watermark-text { color: #002147; }
        .theme-gold-classic .cert-logo-divider { border-color: rgba(184, 134, 11, 0.4); }
        .theme-gold-classic .cert-title-gradient {
            background: linear-gradient(to bottom, #cfc09f 22%, #634f2c 24%, #cfc09f 26%, #cfc09f 27%, #ffecb3 40%, #3a2c0f 78%); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: #b8860b; 
            text-shadow: 0px 1px 1px rgba(0,0,0,0.1);
        }
        .theme-gold-classic .cert-accent-line {
            background: linear-gradient(to right, transparent, #b8860b);
        }
        .theme-gold-classic .cert-accent-line-rev {
            background: linear-gradient(to left, transparent, #b8860b);
        }
        .theme-gold-classic .cert-event-title { color: #b8860b; }
        .theme-gold-classic .cert-serial-num { color: rgba(0, 33, 71, 0.6); }
        .theme-gold-classic .cert-theme-box {
            border-color: #e5e7eb;
            background-color: transparent;
        }

        .page-container {
            width: 297mm;
            height: 210mm; 
            margin: 20px auto; 
            position: relative; 
            overflow: hidden;
            box-sizing: border-box;
            display: flex;
            flex-direction: column; 
            padding: 38px 48px; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.15); 
            background-color: white;
            transition: all 0.3s ease;
        }

        @media print {
            body, html { margin: 0 !important; padding: 0 !important; height: 100% !important; width: 100% !important; overflow: hidden !important; background: white !important; }
            .no-print { display: none !important; }
            .page-container { position: absolute !important; top: 0 !important; left: 0 !important; width: 297mm !important; height: 210mm !important; margin: 0 !important; box-shadow: none !important; border: none !important; z-index: 9999; page-break-after: avoid !important; page-break-before: avoid !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .mix-blend-multiply { mix-blend-mode: multiply; }
        }

        .signature-section {
            display: grid; grid-template-columns: 1fr 1fr;
            width: 100%; margin-top: auto; padding-top: 10px;
            position: relative; z-index: 20;
        }
        .signature-box { display: flex; flex-direction: column; align-items: center; justify-content: flex-end; }
        .img-area {
            height: 90px; width: 220px; position: relative;
            display: flex; justify-content: center; align-items: flex-end; margin-bottom: 4px;
        }
        .ttd-img { height: 60px; width: auto; object-fit: contain; position: relative; z-index: 10; bottom: 0; }
        .cap-img {
            height: 85px; width: auto; position: absolute;
            top: -5px; left: 50%; transform: translateX(-50%);
            z-index: 20; opacity: 0.85; mix-blend-mode: multiply;
        }
        .name-line {
            border-top: 1px solid #111; width: 260px; text-align: center;
            padding-top: 6px; font-weight: 700; color: #002147; font-size: 13px;
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body id="cert-body" class="theme-emerald-2026 bg-slate-900/90 font-body flex flex-col items-center min-h-screen py-8">

    {{-- ══════════ FLOATING TOOLBAR AKSI (ATAS) ══════════ --}}
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex flex-wrap items-center justify-center gap-3 bg-white/95 backdrop-blur-md px-5 py-2.5 rounded-2xl shadow-2xl border border-gray-200 no-print max-w-[95vw]">
        
        {{-- Pilihan Palet Warna --}}
        <div class="flex items-center gap-1.5">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1">
                <i class="fas fa-palette text-emerald-600"></i> Warna:
            </span>
            <button onclick="setTheme('theme-emerald-2026')" id="theme-btn-emerald"
                class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-emerald-700 text-white shadow-sm transition flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-emerald-300"></span> Emerald 2026
            </button>
            <button onclick="setTheme('theme-sapphire-2026')" id="theme-btn-sapphire"
                class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-gray-100 text-blue-900 hover:bg-blue-50 transition flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Sapphire
            </button>
            <button onclick="setTheme('theme-gold-classic')" id="theme-btn-gold"
                class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-gray-100 text-amber-900 hover:bg-amber-50 transition flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span> Gold 2025
            </button>
        </div>

        <div class="h-4 w-px bg-gray-300 hidden sm:block"></div>

        {{-- Pilihan Peran --}}
        <div class="flex items-center gap-1">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mr-1 hidden md:inline">Peran:</span>
            <button onclick="changeRole('Peserta Seminar')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">Peserta</button>
            <button onclick="changeRole('Pembicara')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 hover:bg-purple-100 transition">Pembicara</button>
            <button onclick="changeRole('Presenter')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 hover:bg-emerald-100 transition">Presenter</button> 
            <button onclick="changeRole('Panitia')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 hover:bg-orange-100 transition">Panitia</button>
            <button onclick="changeRole('Web Developer')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 transition">Web Dev</button>
        </div>

        <div class="h-4 w-px bg-gray-300"></div>

        {{-- TOMBOL UTAMA: UNDUH GAMBAR (HD) --}}
        <button id="btn-download-image" onclick="unduhGambarSertifikat()"
            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-4 py-1.5 rounded-xl text-xs font-bold shadow-md shadow-emerald-600/30 transition-all transform hover:scale-105 flex items-center gap-2">
            <i class="fas fa-image text-sm"></i>
            <span>UNDUH GAMBAR</span>
        </button>

        {{-- TOMBOL OPSIONAL: SIMPAN PDF --}}
        <button onclick="window.print()" title="Cetak atau Simpan sebagai PDF"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
            <i class="fas fa-file-pdf text-red-500"></i>
            <span class="hidden sm:inline">PDF</span>
        </button>

        {{-- Tombol Tutup --}}
        <a href="{{ route('peserta.riwayat') }}" class="text-gray-400 hover:text-gray-700 transition ml-1" title="Kembali">
            <i class="fas fa-times text-base"></i>
        </a>
    </div>

    {{-- NOTIFIKASI PROSES GENERATE GAMBAR --}}
    <div id="toast-loading" class="fixed bottom-6 right-6 z-50 hidden bg-gray-900/90 text-white px-5 py-3 rounded-2xl shadow-2xl backdrop-blur-md flex items-center gap-3 no-print">
        <i class="fas fa-spinner fa-spin text-emerald-400 text-lg"></i>
        <div>
            <p class="text-xs font-bold">Sedang Merender Gambar HD...</p>
            <p class="text-[10px] text-gray-300">Resolusi tinggi 300 DPI, mohon tunggu sebentar</p>
        </div>
    </div>

    {{-- ══════════ KANVAS SERTIFIKAT (A4 LANDSCAPE) ══════════ --}}
    <div class="page-container bg-pattern mt-8">
        
        {{-- Border Ganda --}}
        <div class="cert-border-outer absolute inset-4 border-[3px] border-double z-0 pointer-events-none transition-colors duration-300"></div>
        <div class="cert-border-inner absolute inset-[20px] border opacity-30 z-0 pointer-events-none transition-colors duration-300"></div>

        {{-- Ornament Sudut --}}
        <div class="cert-corner absolute top-4 left-4 w-28 h-28 z-0 pointer-events-none transition-colors duration-300">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="cert-corner absolute top-4 right-4 w-28 h-28 z-0 pointer-events-none transform scale-x-[-1] transition-colors duration-300">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="cert-corner absolute bottom-4 left-4 w-28 h-28 z-0 pointer-events-none transform scale-y-[-1] transition-colors duration-300">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="cert-corner absolute bottom-4 right-4 w-28 h-28 z-0 pointer-events-none transform scale-[-1] transition-colors duration-300">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>

        {{-- Watermark Seal ASASI di Tengah --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.035] pointer-events-none z-0">
            <div class="cert-watermark-seal w-[450px] h-[450px] border-[15px] rounded-full flex items-center justify-center transition-colors duration-300">
                <span class="cert-watermark-text text-[100px] font-luxury font-bold transition-colors duration-300">ASASI</span>
            </div>
        </div>

        {{-- Konten Utama Sertifikat --}}
        <div class="relative z-10 w-full h-full flex flex-col">
            
            {{-- Header Baris Logo --}}
            <div class="cert-logo-divider relative w-full border-b pb-4 mb-4 shrink-0 transition-colors duration-300">
                <div class="flex items-end justify-center gap-3 w-full px-4">
                    {{-- UTAMA --}}
                    <img src="{{ asset('storage/starnas.png') }}" class="h-10 w-auto object-contain" alt="Starnas">
                    <img src="{{ asset('storage/logo-asasi.png') }}" class="h-8 w-auto object-contain" alt="ASASI">
                    
                    <div class="h-6 w-px bg-gray-300 mx-1"></div>

                    {{-- MITRA --}}
                    <img src="{{ asset('storage/logo-uim.png') }}" class="h-7 w-auto object-contain" alt="UIM">
                    <img src="{{ asset('storage/sptn.png') }}" class="h-7 w-auto object-contain" alt="SPTN">
                    <img src="{{ asset('storage/pinestilu.png') }}" class="h-7 w-auto object-contain" alt="Pinestilu">
                    <img src="{{ asset('storage/morikafe.png') }}" class="h-7 w-auto object-contain" alt="Morikafe">
                    <img src="{{ asset('storage/edutech.png') }}" class="h-7 w-auto object-contain" alt="Edutech">
                    <img src="{{ asset('storage/edukator.webp') }}" class="h-7 w-auto object-contain" alt="Edukator">
                </div>
            </div>

            {{-- Isi Tengah --}}
            <div class="flex-grow flex flex-col items-center text-center w-full">
                <div class="mt-2 mb-2">
                    <h1 class="cert-title-gradient text-5xl font-luxury font-bold tracking-widest drop-shadow-sm leading-tight uppercase transition-all duration-300">
                        Sertifikat Penghargaan
                    </h1>
                    
                    {{-- Nomor Seri --}}
                    <p class="cert-serial-num text-xs font-mono font-bold tracking-widest mt-1 mb-2 transition-colors duration-300">
                        No. Seri: {{ $nomor_unik }}
                    </p>
                    
                    <p class="text-gray-500 font-script text-2xl mt-1">Diberikan dengan hormat kepada:</p>
                </div>

                {{-- Nama Peserta --}}
                <div class="relative py-2 mb-4 w-full flex items-center justify-center gap-4 px-8">
                    <div class="cert-accent-line h-[1.5px] flex-grow max-w-[120px] transition-all duration-300"></div>
                    <h2 class="font-serif-classic text-3xl md:text-4xl font-bold text-slate-900 tracking-wide text-center leading-tight break-words max-w-3xl">
                        {{ $nama_peserta }}
                    </h2>
                    <div class="cert-accent-line-rev h-[1.5px] flex-grow max-w-[120px] transition-all duration-300"></div>
                </div>

                {{-- Dedikasi & Peran --}}
                <div class="flex flex-col items-center gap-2.5 w-full max-w-4xl">
                    <p class="text-xs text-gray-500 font-body uppercase tracking-widest font-semibold">
                        Atas kontribusi dan dedikasinya sebagai
                    </p>
                    <div class="relative inline-block my-1">
                        <span id="role-badge" class="relative block bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-900 text-white border border-white/30 px-9 py-1.5 text-lg font-bold rounded-full shadow-lg tracking-widest uppercase font-serif-classic">
                            {{ $peran_peserta }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 font-body">dalam acara :</p>
                    <h3 class="cert-event-title text-2xl font-bold uppercase tracking-wide font-luxury drop-shadow-sm transition-colors duration-300">
                        STARNAS ASASI &amp; ICoABCD 2026
                    </h3>
                </div>

                {{-- Box Tema --}}
                <div class="cert-theme-box mt-3 relative px-8 py-2 w-full max-w-3xl border rounded-xl transition-colors duration-300">
                    <p class="text-base text-gray-800 italic font-serif-classic leading-relaxed">
                        "<span class="font-bold text-slate-900 not-italic">Tema:</span> {{ $tema }}"
                    </p>
                    <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest font-semibold">
                        Yogyakarta, 01 Desember 2026 &bull; {{ $tempat_acara }}
                    </p>
                </div>
            </div>

            {{-- Bagian Tanda Tangan & Cap --}}
            <div class="signature-section">
                <div class="signature-box" style="align-items: flex-start; padding-left: 30px;">
                    <div style="width: 260px; text-align: center;">
                        <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Ketua Umum ASASI</p>
                        <div class="img-area">
                            <img src="{{ asset('storage/ttd_elfahmi.png') }}" class="ttd-img" alt="TTD">
                            <img src="{{ asset('storage/capasasi.png') }}" class="cap-img" alt="Cap" style="left: 55%;">
                        </div>
                        <div class="name-line">Prof. Dr. Elfahmi, S.Si., M.Si.</div>
                    </div>
                </div>
                <div class="signature-box" style="align-items: flex-end; padding-right: 30px;">
                    <div style="width: 260px; text-align: center;">
                        <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Ketua Panitia Pelaksana</p>
                        <div class="img-area">
                            <img src="{{ asset('storage/ttdsoni.png') }}" class="ttd-img" alt="TTD">
                            <img src="{{ asset('storage/capstarnas.png') }}" class="cap-img" alt="Cap" style="left: 45%;">
                        </div>
                        <div class="name-line">Soni Ariawan, M.Ed.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // GANTI PERAN (BADGE)
        function changeRole(roleName) {
            const badge = document.getElementById('role-badge');
            let colorClasses = '';

            if (roleName === 'Peserta Seminar') {
                colorClasses = 'from-blue-700 via-indigo-700 to-blue-900';
            } else if (roleName === 'Pembicara') {
                colorClasses = 'from-purple-700 via-fuchsia-700 to-purple-900';
            } else if (roleName === 'Presenter') {
                colorClasses = 'from-emerald-700 via-teal-700 to-emerald-900';
            } else if (roleName === 'Panitia') {
                colorClasses = 'from-amber-600 via-orange-600 to-amber-700';
            } else if (roleName === 'Web Developer') { 
                colorClasses = 'from-rose-700 via-red-800 to-rose-900';
            } else {
                colorClasses = 'from-emerald-700 via-teal-700 to-emerald-900';
            }

            badge.style.transform = 'scale(0.95)';
            badge.style.opacity = '0.5';

            setTimeout(() => {
                badge.innerText = roleName;
                badge.className = 'relative block bg-gradient-to-r ' + colorClasses + ' text-white border border-white/30 px-9 py-1.5 text-lg font-bold rounded-full shadow-lg tracking-widest uppercase font-serif-classic';
                badge.style.transform = 'scale(1)';
                badge.style.opacity = '1';
            }, 120);
        }

        // GANTI PALET TEMA WARNA
        function setTheme(themeName) {
            const body = document.getElementById('cert-body');
            body.classList.remove('theme-emerald-2026', 'theme-sapphire-2026', 'theme-gold-classic');
            body.classList.add(themeName);

            // Update button styles
            const btnEmerald = document.getElementById('theme-btn-emerald');
            const btnSapphire = document.getElementById('theme-btn-sapphire');
            const btnGold = document.getElementById('theme-btn-gold');

            [btnEmerald, btnSapphire, btnGold].forEach(b => {
                b.className = 'text-[10px] font-bold px-2.5 py-1 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition flex items-center gap-1';
            });

            if (themeName === 'theme-emerald-2026') {
                btnEmerald.className = 'text-[10px] font-bold px-2.5 py-1 rounded-lg bg-emerald-700 text-white shadow-sm transition flex items-center gap-1';
            } else if (themeName === 'theme-sapphire-2026') {
                btnSapphire.className = 'text-[10px] font-bold px-2.5 py-1 rounded-lg bg-blue-700 text-white shadow-sm transition flex items-center gap-1';
            } else if (themeName === 'theme-gold-classic') {
                btnGold.className = 'text-[10px] font-bold px-2.5 py-1 rounded-lg bg-amber-700 text-white shadow-sm transition flex items-center gap-1';
            }
        }

        // FUNGSI UNDUH GAMBAR (HD PNG)
        async function unduhGambarSertifikat() {
            const btn = document.getElementById('btn-download-image');
            const toast = document.getElementById('toast-loading');
            const originalContent = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> <span>MENGUNDUH...</span>';
            toast.classList.remove('hidden');

            try {
                // Tunggu font siap
                if (document.fonts && document.fonts.ready) {
                    await document.fonts.ready;
                }

                const element = document.querySelector('.page-container');
                
                // Gunakan html2canvas dengan scale 2.8 untuk resolusi HD siap cetak
                const canvas = await html2canvas(element, {
                    scale: 2.8,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    scrollX: 0,
                    scrollY: 0
                });

                // Trigger download
                const link = document.createElement('a');
                const namaBersih = "{{ Str::slug($nama_peserta ?? 'Peserta') }}";
                link.download = `Sertifikat_STARNAS_2026_${namaBersih}.png`;
                link.href = canvas.toDataURL('image/png', 1.0);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch (err) {
                console.error(err);
                alert('Gagal mengunduh gambar: ' + err.message);
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalContent;
                toast.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
