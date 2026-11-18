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

    <!-- Font Awesome & Google Fonts (Classic Luxury Serif & Cursive) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Great+Vibes&family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,900;1,400;1,600&display=swap" rel="stylesheet">
    
    <!-- Library Render Gambar HD (html2canvas + html-to-image fallback) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>

    <style>
        /* ══════════ RESET & BASE TYPOGRAPHY ══════════ */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #0b131e;
            font-family: 'Montserrat', sans-serif;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 30px 15px 50px 15px;
            -webkit-font-smoothing: antialiased;
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        /* ══════════ FLOATING TOOLBAR AKSI (ATAS) ══════════ */
        .toolbar-wrapper {
            position: fixed;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 7px 18px;
            border-radius: 9999px;
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.28), 0 0 0 1px rgba(0, 0, 0, 0.07);
        }

        .role-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .role-title {
            font-size: 10.5px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-right: 4px;
        }

        .role-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            color: #475569;
            cursor: pointer;
            transition: all 0.15s ease;
            font-family: 'Montserrat', sans-serif;
        }

        .role-pill:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        .role-pill.active {
            background: #064e3b;
            color: #ffffff;
            border-color: #064e3b;
            box-shadow: 0 2px 8px rgba(6, 78, 59, 0.35);
        }

        .toolbar-sep {
            height: 20px;
            width: 1px;
            background-color: #cbd5e1;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: linear-gradient(135deg, #059669 0%, #047857 50%, #064e3b 100%);
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 8px 20px;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
            transition: all 0.2s ease;
        }

        .btn-download:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(5, 150, 105, 0.55);
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        }

        .btn-pdf {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: #f1f5f9;
            color: #334155;
            font-family: 'Montserrat', sans-serif;
            font-size: 11.5px;
            font-weight: 700;
            padding: 8px 14px;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-pdf:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        .btn-close {
            color: #94a3b8;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 4px;
            text-decoration: none;
            transition: color 0.15s ease;
            margin-left: 2px;
        }

        .btn-close:hover {
            color: #1e293b;
        }

        /* ══════════ KANVAS SERTIFIKAT LUXURY 2026 (A4 LANDSCAPE) ══════════ */
        .page-container {
            width: 297mm;
            height: 210mm;
            margin: 45px auto 20px auto;
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            padding: 34px 46px 28px 46px;
            background-color: #ffffff;
            /* Pola mikro-keamanan sertifikat mewah (halus & bersih tanpa watermark lingkaran besar) */
            background-image: 
                radial-gradient(rgba(6, 78, 59, 0.04) 1px, transparent 1px),
                radial-gradient(rgba(212, 175, 55, 0.03) 1px, #ffffff 1px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            box-shadow: 0 25px 65px rgba(0, 0, 0, 0.45);
        }

        /* ── BORDER FRAME MEWAH 2026 ── */
        .frame-outer-gold {
            position: absolute;
            top: 14px; left: 14px; right: 14px; bottom: 14px;
            border: 1.5px solid #c59b27;
            pointer-events: none;
            z-index: 1;
        }

        .frame-mid-emerald {
            position: absolute;
            top: 20px; left: 20px; right: 20px; bottom: 20px;
            border: 3.5px double #064e3b;
            pointer-events: none;
            z-index: 1;
        }

        .frame-inner-gold {
            position: absolute;
            top: 28px; left: 28px; right: 28px; bottom: 28px;
            border: 1px solid rgba(212, 175, 55, 0.6);
            pointer-events: none;
            z-index: 1;
        }

        /* ── CORNER ORNAMENTS (VEKTOR SUDUT FILIGREE) ── */
        .corner-ornament {
            position: absolute;
            width: 76px;
            height: 76px;
            pointer-events: none;
            z-index: 2;
        }
        .corner-tl { top: 22px; left: 22px; }
        .corner-tr { top: 22px; right: 22px; transform: scaleX(-1); }
        .corner-bl { bottom: 22px; left: 22px; transform: scaleY(-1); }
        .corner-br { bottom: 22px; right: 22px; transform: scale(-1); }

        /* ── STRUKTUR KONTEN KANVAS ── */
        .cert-content {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ── HEADER LOGO PENYELENGGARA & MITRA ── */
        .cert-header {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 8px;
        }

        .logo-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            width: 100%;
            padding: 0 10px;
        }

        .logo-primary-group {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-divider {
            height: 28px;
            width: 1.5px;
            background: linear-gradient(to bottom, transparent, #c59b27, transparent);
            margin: 0 4px;
        }

        .logo-partners-group {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .logo-img-starnas { height: 38px; width: auto; object-fit: contain; }
        .logo-img-asasi { height: 32px; width: auto; object-fit: contain; }
        .logo-img-partner { height: 26px; width: auto; object-fit: contain; }

        .header-decor-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 82%;
            margin-top: 7px;
        }

        .header-line {
            flex-grow: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, #c59b27, #064e3b, #c59b27, transparent);
        }

        .header-gem {
            color: #c59b27;
            font-size: 8px;
            line-height: 1;
        }

        /* ── KONTEN TENGAH / UTAMA SERTIFIKAT ── */
        .cert-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: -2px;
        }

        .cert-main-title {
            font-family: 'Cinzel', serif;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: 7px;
            text-transform: uppercase;
            color: #064e3b;
            line-height: 1.1;
            margin-bottom: 2px;
            text-shadow: 0 1px 2px rgba(6, 78, 59, 0.15);
        }

        .cert-serial-number {
            font-family: 'Montserrat', sans-serif;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 2.5px;
            color: #047857;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .cert-salutation {
            font-family: 'Great Vibes', cursive;
            font-size: 24px;
            color: #526071;
            margin-bottom: 3px;
        }

        /* ── NAMA PESERTA ── */
        .name-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            width: 100%;
            max-width: 860px;
            margin: 4px 0 6px 0;
        }

        .name-flourish {
            flex-grow: 1;
            max-width: 110px;
            height: 1.5px;
        }

        .flourish-left {
            background: linear-gradient(to right, transparent, #c59b27);
        }

        .flourish-right {
            background: linear-gradient(to left, transparent, #c59b27);
        }

        .cert-name {
            font-family: 'Playfair Display', serif;
            font-size: 34px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: 0.5px;
            line-height: 1.15;
            word-break: break-word;
            padding: 0 8px;
        }

        /* ── DEDIKASI & BADGE PERAN ── */
        .cert-dedication {
            font-family: 'Montserrat', sans-serif;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #556579;
            margin-top: 3px;
            margin-bottom: 6px;
        }

        .cert-badge-wrapper {
            margin-bottom: 6px;
        }

        .cert-badge {
            display: inline-block;
            padding: 6px 36px;
            border-radius: 9999px;
            background: linear-gradient(135deg, #064e3b 0%, #0d5f47 50%, #043e2e 100%);
            border: 1.5px solid #d4af37;
            box-shadow: 0 4px 14px rgba(6, 78, 59, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            color: #ffffff;
            font-family: 'Cinzel', serif;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            transition: all 0.2s ease;
        }

        .cert-event-lead {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px;
            font-style: italic;
            color: #64748b;
            margin-bottom: 2px;
        }

        .cert-event-title {
            font-family: 'Cinzel', serif;
            font-size: 21px;
            font-weight: 800;
            color: #064e3b;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        /* ── KOTAK TEMA ACARA (LUXURY PLAQUE) ── */
        .theme-plaque {
            width: 100%;
            max-width: 800px;
            background: linear-gradient(135deg, rgba(254, 252, 232, 0.5) 0%, rgba(240, 253, 244, 0.6) 100%);
            border: 1px solid #d4af37;
            border-radius: 6px;
            padding: 7px 22px;
            box-shadow: inset 0 0 8px rgba(212, 175, 55, 0.08);
            margin-bottom: 4px;
        }

        .theme-quote {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 13px;
            color: #1e293b;
            line-height: 1.35;
        }

        .theme-quote-label {
            font-weight: 700;
            font-style: normal;
            color: #064e3b;
        }

        .theme-date-place {
            font-family: 'Montserrat', sans-serif;
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #047857;
            text-transform: uppercase;
            margin-top: 3px;
        }

        /* ── TANDA TANGAN & STEMPEL ── */
        .cert-signatures {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 35px 2px 35px;
            margin-top: auto;
        }

        .sig-col {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 250px;
            text-align: center;
        }

        .sig-role {
            font-family: 'Montserrat', sans-serif;
            font-size: 9.5px;
            font-weight: 800;
            color: #475569;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .sig-image-box {
            height: 64px;
            width: 210px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin-bottom: 3px;
        }

        .sig-img {
            height: 52px;
            width: auto;
            object-fit: contain;
            position: relative;
            z-index: 10;
        }

        .stamp-img {
            height: 72px;
            width: auto;
            position: absolute;
            top: -6px;
            z-index: 15;
            opacity: 0.88;
            mix-blend-mode: multiply;
        }

        .stamp-left { left: 54%; transform: translateX(-50%); }
        .stamp-right { left: 46%; transform: translateX(-50%); }

        .sig-line {
            border-top: 1.5px solid #0f172a;
            width: 240px;
            text-align: center;
            padding-top: 4px;
            font-weight: 700;
            color: #0f172a;
            font-size: 12.5px;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.2px;
        }

        /* ══════════ TOAST NOTIFIKASI RENDER ══════════ */
        .toast-render {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 2000;
            display: none;
            align-items: center;
            gap: 12px;
            background-color: #0f172a;
            color: #ffffff;
            padding: 12px 22px;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
            border: 1px solid #334155;
            font-family: 'Montserrat', sans-serif;
        }

        .toast-render .icon-spin {
            font-size: 18px;
            color: #34d399;
        }

        .toast-render h4 {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .toast-render p {
            font-size: 10px;
            color: #94a3b8;
        }

        /* ══════════ PRINT OPTIMIZATION (CETAK / PDF) ══════════ */
        @media print {
            body, html {
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                height: 100% !important;
                width: 100% !important;
                overflow: hidden !important;
            }

            .no-print, .toolbar-wrapper, .toast-render {
                display: none !important;
            }

            .page-container {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 297mm !important;
                height: 210mm !important;
                margin: 0 !important;
                box-shadow: none !important;
                border: none !important;
                z-index: 9999;
                page-break-after: avoid !important;
                page-break-before: avoid !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .stamp-img {
                mix-blend-mode: multiply !important;
            }
        }
    </style>
</head>
<body>

    {{-- ══════════ FLOATING TOOLBAR AKSI (ATAS) ══════════ --}}
    <div class="toolbar-wrapper no-print">
        
        {{-- Pilihan Peran --}}
        <div class="role-group">
            <span class="role-title">Peran:</span>
            <button type="button" onclick="changeRole('Peserta Seminar', this)" class="role-pill {{ $peran_peserta == 'Peserta Seminar' ? 'active' : '' }}">Peserta</button>
            <button type="button" onclick="changeRole('Pembicara', this)" class="role-pill {{ $peran_peserta == 'Pembicara' ? 'active' : '' }}">Pembicara</button>
            <button type="button" onclick="changeRole('Presenter', this)" class="role-pill {{ $peran_peserta == 'Presenter' ? 'active' : '' }}">Presenter</button> 
            <button type="button" onclick="changeRole('Panitia', this)" class="role-pill {{ $peran_peserta == 'Panitia' ? 'active' : '' }}">Panitia</button>
            <button type="button" onclick="changeRole('Web Developer', this)" class="role-pill {{ $peran_peserta == 'Web Developer' ? 'active' : '' }}">Web Dev</button>
        </div>

        <div class="toolbar-sep"></div>

        {{-- TOMBOL UTAMA: UNDUH GAMBAR (PNG HD SIAP CETAK) --}}
        <button id="btn-download-image" onclick="unduhGambarSertifikat()" class="btn-download" title="Unduh gambar beresolusi tinggi 300 DPI">
            <i class="fas fa-file-image"></i>
            <span>UNDUH GAMBAR</span>
        </button>

        {{-- TOMBOL SEKUNDER: SIMPAN PDF --}}
        <button onclick="window.print()" class="btn-pdf" title="Cetak atau Simpan sebagai PDF">
            <i class="fas fa-file-pdf" style="color: #ef4444;"></i>
            <span>PDF</span>
        </button>

        {{-- Tombol Tutup --}}
        <a href="{{ route('peserta.riwayat') }}" class="btn-close" title="Kembali ke Riwayat">
            <i class="fas fa-times"></i>
        </a>
    </div>

    {{-- ══════════ TOAST NOTIFIKASI PROSES RENDER ══════════ --}}
    <div id="toast-loading" class="toast-render no-print">
        <i class="fas fa-spinner fa-spin icon-spin"></i>
        <div>
            <h4>Sedang Merender Gambar HD...</h4>
            <p>Resolusi 300 DPI, gambar akan terunduh otomatis</p>
        </div>
    </div>

    {{-- ══════════ KANVAS SERTIFIKAT RESMI 2026 (A4 LANDSCAPE) ══════════ --}}
    <div class="page-container">
        
        {{-- Triple Frame Mewah (Gold & Royal Emerald 2026) --}}
        <div class="frame-outer-gold"></div>
        <div class="frame-mid-emerald"></div>
        <div class="frame-inner-gold"></div>

        {{-- 4 Sudut Filigree Ornamen Vektor Mewah --}}
        <div class="corner-ornament corner-tl">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 6 6 L 46 6 M 6 6 L 6 46" stroke="#c59b27" stroke-width="2" />
                <path d="M 12 12 L 40 12 M 12 12 L 12 40" stroke="#064e3b" stroke-width="1.5" />
                <path d="M 12 12 C 22 22 34 18 44 18 C 54 18 62 26 62 36 C 62 50 42 56 42 68" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 12 12 C 22 22 18 34 18 44 C 18 54 26 62 36 62 C 50 62 56 42 68 42" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 24 24 C 32 16 42 20 46 28 C 38 28 34 34 34 40 C 26 36 22 30 24 24 Z" fill="#064e3b" opacity="0.85" />
                <path d="M 24 24 C 16 32 20 42 28 46 C 28 38 34 34 40 34 C 36 26 30 22 24 24 Z" fill="#064e3b" opacity="0.85" />
                <polygon points="12,7 14.5,12 19.5,12 15.5,15.5 17,20.5 12,17.5 7,20.5 8.5,15.5 4.5,12 9.5,12" fill="#d4af37" />
            </svg>
        </div>
        <div class="corner-ornament corner-tr">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 6 6 L 46 6 M 6 6 L 6 46" stroke="#c59b27" stroke-width="2" />
                <path d="M 12 12 L 40 12 M 12 12 L 12 40" stroke="#064e3b" stroke-width="1.5" />
                <path d="M 12 12 C 22 22 34 18 44 18 C 54 18 62 26 62 36 C 62 50 42 56 42 68" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 12 12 C 22 22 18 34 18 44 C 18 54 26 62 36 62 C 50 62 56 42 68 42" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 24 24 C 32 16 42 20 46 28 C 38 28 34 34 34 40 C 26 36 22 30 24 24 Z" fill="#064e3b" opacity="0.85" />
                <path d="M 24 24 C 16 32 20 42 28 46 C 28 38 34 34 40 34 C 36 26 30 22 24 24 Z" fill="#064e3b" opacity="0.85" />
                <polygon points="12,7 14.5,12 19.5,12 15.5,15.5 17,20.5 12,17.5 7,20.5 8.5,15.5 4.5,12 9.5,12" fill="#d4af37" />
            </svg>
        </div>
        <div class="corner-ornament corner-bl">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 6 6 L 46 6 M 6 6 L 6 46" stroke="#c59b27" stroke-width="2" />
                <path d="M 12 12 L 40 12 M 12 12 L 12 40" stroke="#064e3b" stroke-width="1.5" />
                <path d="M 12 12 C 22 22 34 18 44 18 C 54 18 62 26 62 36 C 62 50 42 56 42 68" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 12 12 C 22 22 18 34 18 44 C 18 54 26 62 36 62 C 50 62 56 42 68 42" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 24 24 C 32 16 42 20 46 28 C 38 28 34 34 34 40 C 26 36 22 30 24 24 Z" fill="#064e3b" opacity="0.85" />
                <path d="M 24 24 C 16 32 20 42 28 46 C 28 38 34 34 40 34 C 36 26 30 22 24 24 Z" fill="#064e3b" opacity="0.85" />
                <polygon points="12,7 14.5,12 19.5,12 15.5,15.5 17,20.5 12,17.5 7,20.5 8.5,15.5 4.5,12 9.5,12" fill="#d4af37" />
            </svg>
        </div>
        <div class="corner-ornament corner-br">
            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M 6 6 L 46 6 M 6 6 L 6 46" stroke="#c59b27" stroke-width="2" />
                <path d="M 12 12 L 40 12 M 12 12 L 12 40" stroke="#064e3b" stroke-width="1.5" />
                <path d="M 12 12 C 22 22 34 18 44 18 C 54 18 62 26 62 36 C 62 50 42 56 42 68" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 12 12 C 22 22 18 34 18 44 C 18 54 26 62 36 62 C 50 62 56 42 68 42" stroke="#c59b27" stroke-width="1.2" fill="none" />
                <path d="M 24 24 C 32 16 42 20 46 28 C 38 28 34 34 34 40 C 26 36 22 30 24 24 Z" fill="#064e3b" opacity="0.85" />
                <path d="M 24 24 C 16 32 20 42 28 46 C 28 38 34 34 40 34 C 36 26 30 22 24 24 Z" fill="#064e3b" opacity="0.85" />
                <polygon points="12,7 14.5,12 19.5,12 15.5,15.5 17,20.5 12,17.5 7,20.5 8.5,15.5 4.5,12 9.5,12" fill="#d4af37" />
            </svg>
        </div>

        {{-- ── ISI KONTEN SERTIFIKAT ── --}}
        <div class="cert-content">
            
            {{-- Header Logo Penyelenggara & Mitra --}}
            <div class="cert-header">
                <div class="logo-row">
                    {{-- Logo Penyelenggara Utama --}}
                    <div class="logo-primary-group">
                        <img src="{{ asset('storage/starnas.png') }}" class="logo-img-starnas" alt="STARNAS Logo">
                        <img src="{{ asset('storage/logo-asasi.png') }}" class="logo-img-asasi" alt="ASASI Logo">
                    </div>

                    <div class="logo-divider"></div>

                    {{-- Logo Mitra Institusi --}}
                    <div class="logo-partners-group">
                        <img src="{{ asset('storage/logo-uim.png') }}" class="logo-img-partner" alt="UIM">
                        <img src="{{ asset('storage/sptn.png') }}" class="logo-img-partner" alt="SPTN">
                        <img src="{{ asset('storage/pinestilu.png') }}" class="logo-img-partner" alt="Pinestilu">
                        <img src="{{ asset('storage/morikafe.png') }}" class="logo-img-partner" alt="Morikafe">
                        <img src="{{ asset('storage/edutech.png') }}" class="logo-img-partner" alt="Edutech">
                        <img src="{{ asset('storage/edukator.webp') }}" class="logo-img-partner" alt="Edukator">
                    </div>
                </div>

                {{-- Garis Dekorasi Pembatas Header --}}
                <div class="header-decor-line">
                    <span class="header-line"></span>
                    <span class="header-gem">◆</span>
                    <span class="header-line"></span>
                </div>
            </div>

            {{-- Body Sertifikat --}}
            <div class="cert-body">
                <h1 class="cert-main-title">
                    Sertifikat Penghargaan
                </h1>
                
                {{-- Nomor Seri Unik --}}
                <p class="cert-serial-number">
                    No. Seri: {{ $nomor_unik }}
                </p>
                
                {{-- Kalimat Penghormatan --}}
                <p class="cert-salutation">
                    Diberikan dengan hormat kepada:
                </p>

                {{-- Nama Peserta dengan Flanking Line Ornamen --}}
                <div class="name-container">
                    <div class="name-flourish flourish-left"></div>
                    <h2 class="cert-name">
                        {{ $nama_peserta }}
                    </h2>
                    <div class="name-flourish flourish-right"></div>
                </div>

                {{-- Dedikasi & Badge Peran --}}
                <p class="cert-dedication">
                    Atas kontribusi dan dedikasinya sebagai
                </p>

                <div class="cert-badge-wrapper">
                    <span id="role-badge" class="cert-badge">
                        {{ $peran_peserta }}
                    </span>
                </div>

                <p class="cert-event-lead">dalam acara :</p>

                <h3 class="cert-event-title">
                    STARNAS ASASI &amp; ICoABCD 2026
                </h3>

                {{-- Plakat Tema Acara Mewah --}}
                <div class="theme-plaque">
                    <p class="theme-quote">
                        "<span class="theme-quote-label">Tema:</span> {{ $tema }}"
                    </p>
                    <p class="theme-date-place">
                        YOGYAKARTA, 01 DESEMBER 2026 &bull; {{ strtoupper($tempat_acara) }}
                    </p>
                </div>
            </div>

            {{-- Bagian Tanda Tangan & Cap Asli --}}
            <div class="cert-signatures">
                {{-- TTD Kiri: Ketua Umum ASASI --}}
                <div class="sig-col">
                    <p class="sig-role">Ketua Umum ASASI</p>
                    <div class="sig-image-box">
                        <img src="{{ asset('storage/ttd_elfahmi.png') }}" class="sig-img" alt="TTD Ketua ASASI">
                        <img src="{{ asset('storage/capasasi.png') }}" class="stamp-img stamp-left" alt="Cap ASASI">
                    </div>
                    <div class="sig-line">
                        Prof. Dr. Elfahmi, S.Si., M.Si.
                    </div>
                </div>

                {{-- TTD Kanan: Ketua Panitia Pelaksana --}}
                <div class="sig-col">
                    <p class="sig-role">Ketua Panitia Pelaksana</p>
                    <div class="sig-image-box">
                        <img src="{{ asset('storage/ttdsoni.png') }}" class="sig-img" alt="TTD Ketua Panitia">
                        <img src="{{ asset('storage/capstarnas.png') }}" class="stamp-img stamp-right" alt="Cap STARNAS">
                    </div>
                    <div class="sig-line">
                        Soni Ariawan, M.Ed.
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════ JAVASCRIPT: INTERAKSI & DOWNLOAD GAMBAR HD BEBAS OKLCH ══════════ --}}
    <script>
        // GANTI PERAN VIA TOOLBAR
        function changeRole(roleName, btn) {
            const badge = document.getElementById('role-badge');
            
            // Perbarui tombol aktif di toolbar
            document.querySelectorAll('.role-pill').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');

            // Palet warna mewah sesuai peran (menggunakan Hex & standard CSS, bebas OKLCH)
            let bgStyle = 'linear-gradient(135deg, #064e3b 0%, #0d5f47 50%, #043e2e 100%)';
            let borderColor = '#d4af37';
            let shadowColor = 'rgba(6, 78, 59, 0.28)';

            if (roleName === 'Peserta Seminar') {
                bgStyle = 'linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #1e40af 100%)';
                borderColor = '#93c5fd';
                shadowColor = 'rgba(30, 58, 138, 0.3)';
            } else if (roleName === 'Pembicara') {
                bgStyle = 'linear-gradient(135deg, #4c1d95 0%, #7c3aed 50%, #5b21b6 100%)';
                borderColor = '#d8b4fe';
                shadowColor = 'rgba(76, 29, 149, 0.3)';
            } else if (roleName === 'Presenter') {
                bgStyle = 'linear-gradient(135deg, #064e3b 0%, #0d5f47 50%, #043e2e 100%)';
                borderColor = '#d4af37';
                shadowColor = 'rgba(6, 78, 59, 0.28)';
            } else if (roleName === 'Panitia') {
                bgStyle = 'linear-gradient(135deg, #78350f 0%, #d97706 50%, #92400e 100%)';
                borderColor = '#fcd34d';
                shadowColor = 'rgba(120, 53, 15, 0.3)';
            } else if (roleName === 'Web Developer') {
                bgStyle = 'linear-gradient(135deg, #881337 0%, #e11d48 50%, #9f1239 100%)';
                borderColor = '#fda4af';
                shadowColor = 'rgba(136, 19, 55, 0.3)';
            }

            badge.style.opacity = '0.35';
            badge.style.transform = 'scale(0.95)';

            setTimeout(() => {
                badge.innerText = roleName;
                badge.style.background = bgStyle;
                badge.style.borderColor = borderColor;
                badge.style.boxShadow = `0 4px 14px ${shadowColor}, inset 0 1px 0 rgba(255, 255, 255, 0.25)`;
                badge.style.opacity = '1';
                badge.style.transform = 'scale(1)';
            }, 120);
        }

        // FUNGSI UTAMA: UNDUH GAMBAR SERTIFIKAT (HD 300 DPI, BULLETPROOF DARI ERROR OKLCH)
        async function unduhGambarSertifikat() {
            const btn = document.getElementById('btn-download-image');
            const toast = document.getElementById('toast-loading');
            const originalContent = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>MENGUNDUH...</span>';
            toast.style.display = 'flex';

            try {
                // Tunggu font siap agar teks sertifikat ter-render dengan sempurna
                if (document.fonts && document.fonts.ready) {
                    await document.fonts.ready;
                }

                const certElement = document.querySelector('.page-container');
                let dataUrl = null;

                // 1. Coba render menggunakan html2canvas dengan skala 3 (kualitas cetak 300 DPI)
                try {
                    const canvas = await html2canvas(certElement, {
                        scale: 3,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff',
                        logging: false,
                        scrollX: 0,
                        scrollY: 0,
                        windowWidth: 1200,
                        onclone: (clonedDoc) => {
                            // Hilangkan bayangan box-shadow pada elemen klona agar potongan gambar bersih
                            const el = clonedDoc.querySelector('.page-container');
                            if (el) {
                                el.style.boxShadow = 'none';
                                el.style.margin = '0';
                            }
                        }
                    });
                    dataUrl = canvas.toDataURL('image/png', 1.0);
                } catch (canvasErr) {
                    console.warn('html2canvas error, beralih ke fallback html-to-image:', canvasErr);
                    
                    // 2. Fallback otomatis ke html-to-image jika html2canvas mengalami kendala
                    if (window.htmlToImage) {
                        dataUrl = await htmlToImage.toPng(certElement, {
                            quality: 1.0,
                            pixelRatio: 3,
                            backgroundColor: '#ffffff'
                        });
                    } else {
                        throw canvasErr;
                    }
                }

                if (!dataUrl) {
                    throw new Error('Gagal merender kanvas gambar sertifikat');
                }

                // Trigger download file gambar ke komputer pengguna
                const link = document.createElement('a');
                const namaBersih = "{{ Str::slug($nama_peserta ?? 'Peserta') }}";
                link.download = `Sertifikat_STARNAS_2026_${namaBersih}.png`;
                link.href = dataUrl;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
            } catch (err) {
                console.error(err);
                alert('Gagal mengunduh gambar sertifikat: ' + (err.message || 'Terjadi kesalahan sistem'));
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalContent;
                toast.style.display = 'none';
            }
        }
    </script>
</body>
</html>
