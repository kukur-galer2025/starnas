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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        @page { size: A4 landscape; margin: 0; }
        
        .font-luxury { font-family: 'Cinzel', serif; } 
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-body { font-family: 'Montserrat', sans-serif; }
        .font-serif-classic { font-family: 'Playfair Display', serif; }

        /* Background sertifikat bersih & elegan (tanpa bubble watermark lingkaran) */
        .cert-bg {
            background-color: #ffffff;
            background-image: 
                linear-gradient(45deg, rgba(6, 95, 70, 0.015) 25%, transparent 25%), 
                linear-gradient(-45deg, rgba(6, 95, 70, 0.015) 25%, transparent 25%), 
                linear-gradient(45deg, transparent 75%, rgba(6, 95, 70, 0.015) 75%), 
                linear-gradient(-45deg, transparent 75%, rgba(6, 95, 70, 0.015) 75%);
            background-size: 24px 24px;
        }

        /* Gradien judul resmi STARNAS 2026: Royal Emerald & Deep Teal */
        .text-title-2026 {
            background: linear-gradient(135deg, #064e3b 0%, #047857 32%, #0d9488 55%, #047857 78%, #064e3b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: #047857;
            text-shadow: 0px 1px 1px rgba(6, 78, 59, 0.12);
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
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2); 
            background-color: #ffffff;
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
            height: 85px; width: 220px; position: relative;
            display: flex; justify-content: center; align-items: flex-end; margin-bottom: 4px;
        }
        .ttd-img { height: 58px; width: auto; object-fit: contain; position: relative; z-index: 10; bottom: 0; }
        .cap-img {
            height: 80px; width: auto; position: absolute;
            top: -5px; left: 50%; transform: translateX(-50%);
            z-index: 20; opacity: 0.85; mix-blend-mode: multiply;
        }
        .name-line {
            border-top: 1.5px solid #0f172a; width: 260px; text-align: center;
            padding-top: 6px; font-weight: 700; color: #0f172a; font-size: 13px;
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-slate-900 font-body flex flex-col items-center min-h-screen py-8">

    {{-- ══════════ FLOATING TOOLBAR AKSI (ATAS) ══════════ --}}
    <div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center gap-3 bg-white/95 backdrop-blur-md px-5 py-2.5 rounded-2xl shadow-2xl border border-gray-200 no-print">
        
        {{-- Pilihan Peran --}}
        <div class="flex items-center gap-1">
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mr-1 hidden sm:inline">Peran:</span>
            <button onclick="changeRole('Peserta Seminar')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition">Peserta</button>
            <button onclick="changeRole('Pembicara')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-purple-50 text-purple-700 hover:bg-purple-100 transition">Pembicara</button>
            <button onclick="changeRole('Presenter')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 hover:bg-emerald-100 transition">Presenter</button> 
            <button onclick="changeRole('Panitia')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-orange-50 text-orange-700 hover:bg-orange-100 transition">Panitia</button>
            <button onclick="changeRole('Web Developer')" class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 transition">Web Dev</button>
        </div>

        <div class="h-4 w-px bg-gray-300"></div>

        {{-- TOMBOL UTAMA: UNDUH GAMBAR (PNG/HD) --}}
        <button id="btn-download-image" onclick="unduhGambarSertifikat()"
            class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-5 py-2 rounded-xl text-xs font-bold shadow-lg shadow-emerald-600/30 transition-all transform hover:scale-105 flex items-center gap-2">
            <i class="fas fa-file-image text-sm"></i>
            <span>UNDUH GAMBAR</span>
        </button>

        {{-- TOMBOL SEKUNDER: SIMPAN PDF --}}
        <button onclick="window.print()" title="Cetak atau Simpan sebagai PDF"
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3.5 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
            <i class="fas fa-file-pdf text-red-500"></i>
            <span class="hidden sm:inline">PDF</span>
        </button>

        {{-- Tombol Tutup --}}
        <a href="{{ route('peserta.riwayat') }}" class="text-gray-400 hover:text-gray-700 transition ml-1" title="Kembali ke Riwayat">
            <i class="fas fa-times text-base"></i>
        </a>
    </div>

    {{-- NOTIFIKASI PROSES GENERATE GAMBAR --}}
    <div id="toast-loading" class="fixed bottom-6 right-6 z-50 hidden bg-gray-900/95 text-white px-5 py-3.5 rounded-2xl shadow-2xl backdrop-blur-md flex items-center gap-3 no-print border border-gray-700">
        <i class="fas fa-spinner fa-spin text-emerald-400 text-lg"></i>
        <div>
            <p class="text-xs font-bold">Sedang Merender Gambar HD...</p>
            <p class="text-[10px] text-gray-300">Resolusi 300 DPI, gambar akan terunduh otomatis</p>
        </div>
    </div>

    {{-- ══════════ KANVAS SERTIFIKAT RESMI 2026 (A4 LANDSCAPE) ══════════ --}}
    <div class="page-container cert-bg mt-10">
        
        {{-- Border Ganda Elegan 2026 --}}
        <div class="absolute inset-4 border-[3px] border-double border-[#065f46] z-0 pointer-events-none"></div>
        <div class="absolute inset-[20px] border border-[#0d9488] opacity-35 z-0 pointer-events-none"></div>

        {{-- Ornament 4 Sudut Mewah 2026 --}}
        <div class="absolute top-4 left-4 w-28 h-28 z-0 pointer-events-none text-[#065f46]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute top-4 right-4 w-28 h-28 z-0 pointer-events-none text-[#065f46] transform scale-x-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute bottom-4 left-4 w-28 h-28 z-0 pointer-events-none text-[#065f46] transform scale-y-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute bottom-4 right-4 w-28 h-28 z-0 pointer-events-none text-[#065f46] transform scale-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>

        {{-- KONTEN UTAMA SERTIFIKAT (BERSIH, TANPA LINGKARAN BESAR) --}}
        <div class="relative z-10 w-full h-full flex flex-col">
            
            {{-- Header Baris Logo --}}
            <div class="relative w-full border-b border-[#065f46]/30 pb-4 mb-4 shrink-0">
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
                    <h1 class="text-title-2026 text-5xl font-luxury font-bold tracking-widest drop-shadow-sm leading-tight uppercase">
                        Sertifikat Penghargaan
                    </h1>
                    
                    {{-- Nomor Seri --}}
                    <p class="text-xs font-mono font-bold text-[#065f46] tracking-widest mt-1 mb-2">
                        No. Seri: {{ $nomor_unik }}
                    </p>
                    
                    <p class="text-gray-500 font-script text-2xl mt-1">Diberikan dengan hormat kepada:</p>
                </div>

                {{-- Nama Peserta (Bersih, Jelas, & Berwibawa) --}}
                <div class="relative py-2 mb-4 w-full flex items-center justify-center gap-4 px-8">
                    <div class="h-[1.5px] bg-gradient-to-r from-transparent to-[#065f46] flex-grow max-w-[120px]"></div>
                    <h2 class="font-serif-classic text-3xl md:text-4xl font-bold text-slate-900 tracking-wide text-center leading-tight break-words max-w-3xl">
                        {{ $nama_peserta }}
                    </h2>
                    <div class="h-[1.5px] bg-gradient-to-l from-transparent to-[#065f46] flex-grow max-w-[120px]"></div>
                </div>

                {{-- Dedikasi & Badge Peran --}}
                <div class="flex flex-col items-center gap-2.5 w-full max-w-4xl">
                    <p class="text-xs text-gray-500 font-body uppercase tracking-widest font-semibold">
                        Atas kontribusi dan dedikasinya sebagai
                    </p>
                    <div class="relative inline-block my-1">
                        <span id="role-badge" class="relative block bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-900 text-white border border-emerald-400/40 px-9 py-1.5 text-lg font-bold rounded-full shadow-md tracking-widest uppercase font-serif-classic">
                            {{ $peran_peserta }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500 font-body">dalam acara :</p>
                    <h3 class="text-2xl font-bold text-[#065f46] uppercase tracking-wide font-luxury drop-shadow-sm">
                        STARNAS ASASI &amp; ICoABCD 2026
                    </h3>
                </div>

                {{-- Box Tema Acara --}}
                <div class="mt-3 relative px-8 py-2 w-full max-w-3xl border border-emerald-200 bg-emerald-50/50 rounded-xl">
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
                colorClasses = 'from-blue-700 via-indigo-700 to-blue-900 border-blue-400/40';
            } else if (roleName === 'Pembicara') {
                colorClasses = 'from-purple-700 via-fuchsia-700 to-purple-900 border-purple-400/40';
            } else if (roleName === 'Presenter') {
                colorClasses = 'from-emerald-700 via-teal-700 to-emerald-900 border-emerald-400/40';
            } else if (roleName === 'Panitia') {
                colorClasses = 'from-amber-600 via-orange-600 to-amber-700 border-amber-400/40';
            } else if (roleName === 'Web Developer') { 
                colorClasses = 'from-rose-700 via-red-800 to-rose-900 border-rose-400/40';
            } else {
                colorClasses = 'from-emerald-700 via-teal-700 to-emerald-900 border-emerald-400/40';
            }

            badge.style.transform = 'scale(0.95)';
            badge.style.opacity = '0.5';

            setTimeout(() => {
                badge.innerText = roleName;
                badge.className = 'relative block bg-gradient-to-r ' + colorClasses + ' text-white border px-9 py-1.5 text-lg font-bold rounded-full shadow-md tracking-widest uppercase font-serif-classic';
                badge.style.transform = 'scale(1)';
                badge.style.opacity = '1';
            }, 120);
        }

        // FUNGSI UNDUH GAMBAR (PNG HD SIAP CETAK)
        async function unduhGambarSertifikat() {
            const btn = document.getElementById('btn-download-image');
            const toast = document.getElementById('toast-loading');
            const originalContent = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> <span>MENGUNDUH...</span>';
            toast.classList.remove('hidden');

            try {
                if (document.fonts && document.fonts.ready) {
                    await document.fonts.ready;
                }

                const element = document.querySelector('.page-container');
                
                const canvas = await html2canvas(element, {
                    scale: 2.8,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff',
                    logging: false,
                    scrollX: 0,
                    scrollY: 0
                });

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
