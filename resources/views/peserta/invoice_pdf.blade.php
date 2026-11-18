<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $nomorInvoice }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            background: #ffffff;
            line-height: 1.6;
        }

        .page {
            width: 100%;
            padding: 36px 44px;
        }

        /* ===== WATERMARK ===== */
        .watermark {
            position: fixed;
            top: 42%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            font-size: 68px;
            font-weight: bold;
            opacity: 0.055;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
            letter-spacing: 4px;
        }
        .watermark-pending  { color: #b45309; }
        .watermark-verified { color: #15803d; }
        .watermark-rejected { color: #b91c1c; }

        /* ===== HEADER ===== */
        .header {
            border-bottom: 3px solid #15803d;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td { vertical-align: middle; }
        .col-logo   { width: 72px; }
        .col-logo img { width: 68px; height: auto; }
        .col-info   { padding-left: 12px; }
        .col-info h1 {
            font-size: 16px;
            font-weight: bold;
            color: #15803d;
            letter-spacing: 0.5px;
        }
        .col-info p { font-size: 9.5px; color: #6b7280; margin-top: 1px; }
        .col-inv    { text-align: right; width: 180px; }
        .col-inv .inv-title {
            font-size: 24px;
            font-weight: bold;
            color: #15803d;
            letter-spacing: 3px;
        }
        .col-inv .inv-num {
            font-size: 9px;
            color: #9ca3af;
            margin-top: 2px;
            word-break: break-all;
        }

        /* ===== STATUS BADGE ===== */
        .status-wrap {
            text-align: center;
            margin-bottom: 18px;
        }
        .badge {
            display: inline-block;
            padding: 4px 22px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .badge-pending  { background: #fef3c7; color: #92400e; border: 1.5px solid #f59e0b; }
        .badge-verified { background: #dcfce7; color: #166534; border: 1.5px solid #16a34a; }
        .badge-rejected { background: #fee2e2; color: #991b1b; border: 1.5px solid #ef4444; }

        /* ===== INFO BOXES (2 kolom pakai float) ===== */
        .info-section { width: 100%; margin-bottom: 18px; overflow: hidden; }
        .info-col-left {
            float: left;
            width: 48%;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px 12px;
        }
        .info-col-right {
            float: right;
            width: 48%;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px 12px;
        }
        .info-col-left h4,
        .info-col-right h4 {
            font-size: 9px;
            font-weight: bold;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #d1fae5;
            padding-bottom: 5px;
            margin-bottom: 7px;
        }
        .info-tbl { width: 100%; border-collapse: collapse; }
        .info-tbl td {
            padding: 2px 0;
            font-size: 10px;
            vertical-align: top;
        }
        .info-tbl td.lbl { color: #9ca3af; width: 40%; padding-right: 6px; }
        .info-tbl td.val { color: #111827; font-weight: 600; }
        .clearfix { clear: both; }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 7px;
            margin-top: 4px;
        }

        /* ===== DETAIL TABLE ===== */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .detail-table thead tr { background: #15803d; }
        .detail-table thead th {
            padding: 7px 10px;
            text-align: left;
            font-size: 9.5px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 0.4px;
        }
        .detail-table tbody tr { border-bottom: 1px solid #e5e7eb; }
        .detail-table tbody td {
            padding: 7px 10px;
            font-size: 10.5px;
            color: #374151;
            vertical-align: top;
        }

        /* ===== TOTAL ===== */
        .total-wrap { text-align: right; margin-bottom: 18px; }
        .total-box {
            display: inline-block;
            background: #f0fdf4;
            border: 2px solid #16a34a;
            border-radius: 6px;
            padding: 10px 20px;
            min-width: 220px;
            text-align: right;
        }
        .total-box .lbl {
            font-size: 9px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .total-box .amt {
            font-size: 19px;
            font-weight: bold;
            color: #15803d;
            margin-top: 2px;
        }

        /* ===== REKENING ===== */
        .rekening-box {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            border-left: 4px solid #f59e0b;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 18px;
        }
        .rekening-box h4 {
            font-size: 9px;
            font-weight: bold;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .rek-tbl { border-collapse: collapse; }
        .rek-tbl td { padding: 2px 10px 2px 0; font-size: 10.5px; }
        .rek-tbl td.lbl { color: #78350f; width: 110px; }
        .rek-tbl td.val { color: #1c1917; font-weight: bold; }

        /* ===== DIVIDER ===== */
        .divider {
            border: none;
            border-top: 1px dashed #d1d5db;
            margin: 14px 0;
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 8.5px;
            line-height: 1.7;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .footer strong { color: #6b7280; }
    </style>
</head>
<body>
<div class="page">

    @php
        $wm = $pembayaran->status === 'verified' ? 'TERVERIFIKASI'
            : ($pembayaran->status === 'rejected' ? 'DITOLAK' : 'BELUM TERVERIFIKASI');
        $wmClass = 'watermark watermark-' . $pembayaran->status;

        $kategoriLabel = [
            'asasi_onsite'     => 'Anggota ASASI (Onsite)',
            'umum_onsite'      => 'Umum (Onsite)',
            'mahasiswa_onsite' => 'Mahasiswa (Onsite)',
            'asasi_online'     => 'Anggota ASASI (Online)',
            'umum_online'      => 'Umum (Online)',
            'mahasiswa_online' => 'Mahasiswa (Online)',
            'non-presenter'    => 'Non-Presenter',
        ][$pembayaran->kategori_pembayaran] ?? $pembayaran->kategori_pembayaran;

        $statusLabel = [
            'pending'  => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
        ][$pembayaran->status] ?? ucfirst($pembayaran->status);

        $badgeClass = 'badge badge-' . $pembayaran->status;
    @endphp

    <div class="{{ $wmClass }}">{{ $wm }}</div>

    {{-- ══════════ HEADER ══════════ --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="col-logo">
                    @if($logoBase64)
                        <img src="{{ $logoBase64 }}" alt="Logo STARNAS">
                    @endif
                </td>
                <td class="col-info">
                    <h1>STARNAS ASASI &amp; ICoABCD 2026</h1>
                    <p>Seminar Nasional &amp; International Conference</p>
                    <p>1 &ndash; 2 Desember 2026 &bull; The Malioboro Hotel, Yogyakarta</p>
                </td>
                <td class="col-inv">
                    <div class="inv-title">INVOICE</div>
                    <div class="inv-num">{{ $nomorInvoice }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ══════════ STATUS BADGE ══════════ --}}
    <div class="status-wrap">
        <span class="{{ $badgeClass }}">{{ $statusLabel }}</span>
    </div>

    {{-- ══════════ INFO PESERTA & INVOICE (2 kolom float) ══════════ --}}
    <div class="info-section">
        <div class="info-col-left">
            <h4>Data Peserta</h4>
            <table class="info-tbl">
                <tr><td class="lbl">Nama</td><td class="val">{{ $user->nama_lengkap }}</td></tr>
                <tr><td class="lbl">Email</td><td class="val">{{ $user->email }}</td></tr>
                <tr><td class="lbl">Institusi</td><td class="val">{{ $user->institusi ?? '-' }}</td></tr>
                <tr><td class="lbl">No. HP</td><td class="val">{{ $user->nomor_handphone ?? '-' }}</td></tr>
                @if($pembayaran->nomor_anggota_asasi)
                <tr><td class="lbl">No. Anggota</td><td class="val">{{ $pembayaran->nomor_anggota_asasi }}</td></tr>
                @endif
            </table>
        </div>
        <div class="info-col-right">
            <h4>Detail Invoice</h4>
            <table class="info-tbl">
                <tr><td class="lbl">No. Invoice</td><td class="val">{{ $nomorInvoice }}</td></tr>
                <tr><td class="lbl">Tgl. Upload</td><td class="val">{{ $pembayaran->created_at->format('d M Y') }}</td></tr>
                <tr><td class="lbl">Tgl. Dibuat</td><td class="val">{{ now()->format('d M Y') }}</td></tr>
                <tr><td class="lbl">Status</td><td class="val">{{ $statusLabel }}</td></tr>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>

    {{-- ══════════ RINCIAN PEMBAYARAN ══════════ --}}
    <div class="section-title">Rincian Pembayaran</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:45%">Deskripsi</th>
                <th style="width:28%">Kategori</th>
                <th style="width:22%; text-align:right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Biaya Registrasi STARNAS ASASI &amp; ICoABCD 2026</td>
                <td>{{ $kategoriLabel }}</td>
                <td style="text-align:right; font-weight:bold;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- ══════════ TOTAL ══════════ --}}
    <div class="total-wrap">
        <div class="total-box">
            <div class="lbl">Total Pembayaran</div>
            <div class="amt">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- ══════════ REKENING ══════════ --}}
    <div class="rekening-box">
        <h4>&#9432; Informasi Rekening Tujuan Transfer</h4>
        <table class="rek-tbl">
            <tr><td class="lbl">Bank</td><td class="val">Bank Syariah Indonesia (BSI)</td></tr>
            <tr><td class="lbl">No. Rekening</td><td class="val">1912749480</td></tr>
            <tr><td class="lbl">Atas Nama</td><td class="val">Abdul Hadi Kadarusno</td></tr>
        </table>
    </div>

    <hr class="divider">

    {{-- ══════════ FOOTER ══════════ --}}
    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem STARNAS pada {{ now()->format('d M Y, H:i') }} WIB.</p>
        <p>Invoice ini <strong>bukan</strong> merupakan bukti pembayaran yang sah &mdash; simpan bukti transfer asli Anda.</p>
        <p>Pertanyaan: <strong>starnas.asasi2026@gmail.com</strong> &bull; WhatsApp: <strong>+62 852-2551-9882</strong></p>
    </div>

</div>
</body>
</html>
