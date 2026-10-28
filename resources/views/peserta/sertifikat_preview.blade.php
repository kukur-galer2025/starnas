<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat STARNAS ASASI & ICoABCD 2026 - {{ $nama_peserta ?? 'Peserta' }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        @page { size: A4 landscape; margin: 0; }
        
        .font-luxury { font-family: 'Cinzel', serif; } 
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-body { font-family: 'Montserrat', sans-serif; }
        .font-serif-classic { font-family: 'Playfair Display', serif; }

        .bg-pattern {
            background-color: #fffaf0; 
            background-image: 
                radial-gradient(circle at 100% 50%, transparent 20%, rgba(184, 134, 11, 0.03) 21%, rgba(184, 134, 11, 0.03) 34%, transparent 35%, transparent),
                radial-gradient(circle at 0% 50%, transparent 20%, rgba(184, 134, 11, 0.03) 21%, rgba(184, 134, 11, 0.03) 34%, transparent 35%, transparent);
            background-size: 100px 100px;
        }

        .text-gold-gradient {
            background: linear-gradient(to bottom, #cfc09f 22%, #634f2c 24%, #cfc09f 26%, #cfc09f 27%, #ffecb3 40%, #3a2c0f 78%); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: #b8860b; 
            text-shadow: 0px 1px 1px rgba(0,0,0,0.1);
        }

        .page-container {
            width: 297mm; height: 210mm; 
            margin: 20px auto; 
            position: relative; 
            overflow: hidden;
            box-sizing: border-box;
            display: flex;
            flex-direction: column; 
            padding: 40px 50px; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.15); 
            background-color: white;
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
<body class="bg-gray-200 font-body flex flex-col items-center min-h-screen py-8">

    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 flex items-center gap-4 bg-white/90 backdrop-blur-md px-5 py-2 rounded-full shadow-xl border border-white/50 no-print">
        <span class="text-[10px] font-bold text-gray-50 uppercase tracking-widest mr-1">Ubah Peran:</span>
        <div class="flex gap-1">
            <button onclick="changeRole('Peserta Seminar')" class="text-[10px] font-bold px-3 py-1 rounded-full bg-blue-50 text-blue-700 hover:bg-blue-100 transition">Peserta</button>
            <button onclick="changeRole('Pembicara')" class="text-[10px] font-bold px-3 py-1 rounded-full bg-purple-50 text-purple-700 hover:bg-purple-100 transition">Pembicara</button>
            <button onclick="changeRole('Presenter')" class="text-[10px] font-bold px-3 py-1 rounded-full bg-green-50 text-green-700 hover:bg-green-100 transition">Presenter</button> 
            <button onclick="changeRole('Panitia')" class="text-[10px] font-bold px-3 py-1 rounded-full bg-orange-50 text-orange-700 hover:bg-orange-100 transition">Panitia</button>
            <button onclick="changeRole('Web Developer')" class="text-[10px] font-bold px-3 py-1 rounded-full bg-red-50 text-red-700 hover:bg-red-100 transition">Web Dev</button>
        </div>
        <div class="h-4 w-px bg-gray-300 mx-1"></div>
        <button onclick="window.print()" class="bg-emerald-600 text-white px-4 py-1.5 rounded-full text-xs font-bold shadow hover:bg-emerald-700 transition flex items-center gap-2">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            SIMPAN PDF
        </button>
        <a href="{{ route('peserta.riwayat') }}" class="text-gray-400 hover:text-gray-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
    </div>

    <div class="page-container bg-pattern">
        <div class="absolute inset-4 border-[3px] border-double border-[#b8860b] z-0 pointer-events-none"></div>
        <div class="absolute inset-[20px] border border-[#002147] opacity-20 z-0 pointer-events-none"></div>

        <div class="absolute top-4 left-4 w-28 h-28 z-0 pointer-events-none text-[#b8860b]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute top-4 right-4 w-28 h-28 z-0 pointer-events-none text-[#b8860b] transform scale-x-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute bottom-4 left-4 w-28 h-28 z-0 pointer-events-none text-[#b8860b] transform scale-y-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>
        <div class="absolute bottom-4 right-4 w-28 h-28 z-0 pointer-events-none text-[#b8860b] transform scale-[-1]">
            <svg viewBox="0 0 100 100" fill="currentColor"><path d="M0,0 L35,0 C15,0 15,15 0,35 Z M4,4 L25,4 C12,4 12,12 4,25 Z" /></svg>
        </div>

        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none z-0">
            <div class="w-[450px] h-[450px] border-[15px] border-[#b8860b] rounded-full flex items-center justify-center">
                <span class="text-[100px] font-luxury font-bold text-[#002147]">ASASI</span>
            </div>
        </div>

        <div class="relative z-10 w-full h-full flex flex-col">
            
            <div class="relative w-full border-b border-[#b8860b]/40 pb-4 mb-4 shrink-0">
                
                {{-- Menggunakan gap-3 agar lebih rapat dan tidak keluar border --}}
                <div class="flex items-end justify-center gap-3 w-full px-4">
                    {{-- UTAMA --}}
                    <img src="{{ asset('storage/starnas.png') }}" class="h-10 w-auto object-contain" alt="Starnas">
                    <img src="{{ asset('storage/logo-asasi.png') }}" class="h-8 w-auto object-contain" alt="ASASI">
                    
                    <div class="h-6 w-px bg-gray-300 mx-1"></div>

                    {{-- MITRA --}}
                    <img src="{{ asset('storage/logo-uts.png') }}" class="h-7 w-auto object-contain" alt="UTS">
                    <img src="{{ asset('storage/logo-lombok.png') }}" class="h-7 w-auto object-contain" alt="Lombok IT">
                    <img src="{{ asset('storage/sptn.png') }}" class="h-7 w-auto object-contain" alt="SPTN">
                    <img src="{{ asset('storage/apji.png') }}" class="h-7 w-auto object-contain" alt="APJI">
                    <img src="{{ asset('storage/pinestilu.png') }}" class="h-7 w-auto object-contain" alt="Pinestilu">
                    <img src="{{ asset('storage/morikafe.png') }}" class="h-7 w-auto object-contain" alt="Morikafe">
                    <img src="{{ asset('storage/edutech.png') }}" class="h-7 w-auto object-contain" alt="Edutech">
                    <img src="{{ asset('storage/edukator.webp') }}" class="h-7 w-auto object-contain" alt="Edukator">
                </div>
            </div>

            <div class="flex-grow flex flex-col items-center text-center w-full">
                <div class="mt-2 mb-2">
                    <h1 class="text-5xl font-luxury font-bold text-gold-gradient tracking-widest drop-shadow-sm leading-tight uppercase">
                        Sertifikat Penghargaan
                    </h1>
                    {{-- NOMOR SERI DIPINDAHKAN KE SINI --}}
                    <p class="text-xs font-mono font-bold text-[#002147]/60 tracking-widest mt-1 mb-2">
                        No. Seri: {{ $nomor_unik }}
                    </p>
                    
                    <p class="text-gray-500 font-script text-2xl mt-1">Diberikan dengan hormat kepada:</p>
                </div>

                <div class="relative py-2 mb-4 w-full flex items-center justify-center gap-4 px-8">
                    <div class="h-[1px] bg-gradient-to-r from-transparent to-[#b8860b] flex-grow max-w-[100px]"></div>
                    <h2 class="font-serif-classic text-3xl md:text-4xl font-bold text-[#002147] tracking-wide text-center leading-tight break-words max-w-3xl">
                        {{ $nama_peserta }}
                    </h2>
                    <div class="h-[1px] bg-gradient-to-l from-transparent to-[#b8860b] flex-grow max-w-[100px]"></div>
                </div>

                <div class="flex flex-col items-center gap-3 w-full max-w-4xl">
                    <p class="text-sm text-gray-600 font-body uppercase tracking-widest font-semibold">
                        Atas kontribusi dan dedikasinya sebagai
                    </p>
                    <div class="relative inline-block my-1">
                        <div class="absolute inset-0 bg-[#b8860b] blur opacity-20 rounded-lg"></div>
                        <span id="role-badge" class="relative block bg-gradient-to-br from-[#002147] to-[#1e3a8a] text-white border border-[#b8860b]/50 px-8 py-1.5 text-lg font-bold rounded shadow-lg tracking-widest uppercase font-serif-classic">
                            {{ $peran_peserta }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 font-body">dalam acara :</p>
                    <h3 class="text-2xl font-bold text-[#b8860b] uppercase tracking-wide font-luxury drop-shadow-sm">
                        STARNAS ASASI & ICoABCD 2026
                    </h3>
                </div>

                <div class="mt-4 relative px-8 py-2 w-full max-w-3xl border-t border-b border-gray-200">
                    <p class="text-lg text-gray-700 italic font-serif-classic leading-relaxed">
                        "<span class="font-bold text-[#002147] not-italic">Tema:</span> {{ $tema }}"
                    </p>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-bold">
                        Yogyakarta, 01 Desember 2026 &bull; {{ $tempat_acara }}
                    </p>
                </div>
            </div>

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
        function changeRole(roleName) {
            const badge = document.getElementById('role-badge');
            let colorClasses = '';

            // LOGIKA WARNA BADGE
            if (roleName === 'Peserta Seminar') {
                colorClasses = 'from-blue-700 to-blue-900';
            } else if (roleName === 'Pembicara') {
                colorClasses = 'from-purple-700 to-purple-900';
            } else if (roleName === 'Presenter') {
                colorClasses = 'from-green-700 to-green-900';
            } else if (roleName === 'Panitia') {
                colorClasses = 'from-orange-700 to-orange-900';
            } else if (roleName === 'Web Developer') { 
                // Warna Khusus Web Developer (Merah Tua/Maroon)
                colorClasses = 'from-red-700 to-red-900';
            } else {
                colorClasses = 'from-[#002147] to-[#1e3a8a]'; // Default
            }

            badge.style.transform = 'scale(0.95)';
            badge.style.opacity = '0.5';

            setTimeout(() => {
                badge.innerText = roleName;
                
                // Hapus semua kelas warna yang mungkin ada
                badge.classList.remove(
                    'from-[#002147]', 'to-[#1e3a8a]', 
                    'from-blue-700', 'to-blue-900', 
                    'from-purple-700', 'to-purple-900', 
                    'from-orange-700', 'to-orange-900', 
                    'from-green-700', 'to-green-900',
                    'from-red-700', 'to-red-900' // Pastikan menghapus kelas warna merah juga
                ); 
                badge.classList.add(...colorClasses.split(' '));

                badge.style.transform = 'scale(1)';
                badge.style.opacity = '1';
            }, 150);
        }
        document.getElementById('role-badge').style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        
        document.addEventListener('DOMContentLoaded', () => {
             const defaultRole = document.getElementById('role-badge').innerText.trim();
        });
    </script>
</body>
</html>