<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $nomorInvoice }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1.2cm 1.5cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9.5pt;
            color: #1f2937;
            background: #ffffff;
            line-height: 1.45;
        }

        /* ===== WATERMARK ===== */
        .watermark {
            position: fixed;
            top: 36%;
            left: 5%;
            right: 5%;
            text-align: center;
            transform: rotate(-30deg);
            font-size: 46pt;
            font-weight: bold;
            letter-spacing: 4px;
            opacity: 0.055;
            z-index: -1000;
        }
        .watermark-pending  { color: #d97706; }
        .watermark-verified { color: #059669; }
        .watermark-rejected { color: #dc2626; }

        /* ===== HEADER ===== */
        .table-header {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            border-bottom: 3px solid #059669;
            padding-bottom: 12px;
            margin-bottom: 16px;
        }
        .table-header td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }
        .col-logo {
            width: 75px;
        }
        .col-logo img {
            width: 68px;
            height: auto;
        }
        .col-header-text {
            padding-left: 12px;
        }
        .col-header-text h1 {
            font-size: 13.5pt;
            font-weight: bold;
            color: #065f46;
            margin: 0;
            line-height: 1.2;
        }
        .col-header-text p {
            font-size: 8.5pt;
            color: #4b5563;
            margin-top: 2px;
            line-height: 1.3;
        }
        .col-inv {
            width: 175px;
            text-align: right;
        }
        .col-inv .inv-title {
            font-size: 20pt;
            font-weight: bold;
            color: #059669;
            letter-spacing: 2px;
            line-height: 1;
        }
        .col-inv .inv-num {
            font-size: 8pt;
            color: #6b7280;
            margin-top: 4px;
        }

        /* ===== STATUS BADGE ===== */
        .status-container {
            text-align: center;
            margin-bottom: 14px;
        }
        .badge {
            display: inline-block;
            padding: 4px 18px;
            border-radius: 20px;
            font-size: 8.5pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .badge-pending  { background: #fef3c7; color: #92400e; border: 1px solid #f59e0b; }
        .badge-verified { background: #dcfce7; color: #166534; border: 1px solid #16a34a; }
        .badge-rejected { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }

        /* ===== 2-COLUMN INFO BOXES ===== */
        .table-info-wrap {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .table-info-wrap td.info-col {
            vertical-align: top;
            width: 48.5%;
            padding: 0;
        }
        .table-info-wrap td.info-gap {
            width: 3%;
            padding: 0;
        }

        .card-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px 12px;
        }
        .card-header {
            font-size: 8.5pt;
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #d1fae5;
            padding-bottom: 4px;
            margin-bottom: 6px;
        }
        .table-card-inner {
            width: 100%;
            border-collapse: collapse;
        }
        .table-card-inner td {
            padding: 2.5px 0;
            font-size: 8.5pt;
            vertical-align: top;
            border: none;
        }
        .table-card-inner td.lbl {
            width: 38%;
            color: #6b7280;
            padding-right: 4px;
        }
        .table-card-inner td.val {
            width: 62%;
            color: #111827;
            font-weight: 600;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 9pt;
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        /* ===== DETAIL TABLE ===== */
        .table-detail {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .table-detail thead tr {
            background: #059669;
            color: #ffffff;
        }
        .table-detail thead th {
            padding: 7px 10px;
            text-align: left;
            font-size: 8.5pt;
            font-weight: bold;
            color: #ffffff;
            border: none;
        }
        .table-detail tbody tr {
            border-bottom: 1px solid #e5e7eb;
        }
        .table-detail tbody td {
            padding: 8px 10px;
            font-size: 9pt;
            color: #374151;
            vertical-align: middle;
            border: none;
            border-bottom: 1px solid #e5e7eb;
        }

        /* ===== TOTAL SUMMARY ===== */
        .table-total-wrap {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .table-total-wrap td {
            border: none;
            padding: 0;
        }
        .total-box {
            width: 100%;
            border-collapse: collapse;
            background: #ecfdf5;
            border: 1.5px solid #059669;
            border-radius: 6px;
        }
        .total-box td {
            padding: 9px 14px;
            vertical-align: middle;
        }
        .total-box .total-label {
            color: #065f46;
            font-size: 8.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .total-box .total-amount {
            text-align: right;
            color: #065f46;
            font-size: 13pt;
            font-weight: bold;
        }

        /* ===== REKENING TRANSFER ===== */
        .table-rekening-wrap {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-left: 4px solid #f59e0b;
            border-radius: 6px;
            margin-bottom: 14px;
        }
        .table-rekening-wrap td {
            padding: 9px 12px;
            border: none;
        }
        .rekening-title {
            font-size: 8.5pt;
            font-weight: bold;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .table-rekening-inner {
            width: 100%;
            border-collapse: collapse;
        }
        .table-rekening-inner td {
            padding: 2px 0;
            font-size: 8.5pt;
            border: none;
        }
        .table-rekening-inner td.rek-lbl {
            width: 110px;
            color: #78350f;
        }
        .table-rekening-inner td.rek-val {
            color: #1f2937;
            font-weight: bold;
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            color: #9ca3af;
            font-size: 7.5pt;
            line-height: 1.6;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            margin-top: 6px;
        }
        .footer .wa-contact {
            margin-top: 3px;
            font-size: 8.5pt;
            font-weight: bold;
            color: #065f46;
        }
    </style>
</head>
<body>

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

    {{-- WATERMARK LATAR --}}
    <div class="{{ $wmClass }}">{{ $wm }}</div>

    {{-- ══════════ HEADER ══════════ --}}
    <table class="table-header">
        <tr>
            <td class="col-logo">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Logo STARNAS">
                @endif
            </td>
            <td class="col-header-text">
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

    {{-- ══════════ STATUS BADGE ══════════ --}}
    <div class="status-container">
        <span class="{{ $badgeClass }}">{{ $statusLabel }}</span>
    </div>

    {{-- ══════════ INFO PESERTA & INVOICE (2 KOLOM TABLE) ══════════ --}}
    <table class="table-info-wrap">
        <tr>
            <td class="info-col">
                <div class="card-box">
                    <div class="card-header">Data Peserta</div>
                    <table class="table-card-inner">
                        <tr><td class="lbl">Nama</td><td class="val">{{ $user->nama_lengkap }}</td></tr>
                        <tr><td class="lbl">Email</td><td class="val">{{ $user->email }}</td></tr>
                        <tr><td class="lbl">Institusi</td><td class="val">{{ $user->institusi ?? '-' }}</td></tr>
                        <tr><td class="lbl">No. HP</td><td class="val">{{ $user->nomor_handphone ?? '-' }}</td></tr>
                        @if($pembayaran->nomor_anggota_asasi)
                        <tr><td class="lbl">No. Anggota</td><td class="val">{{ $pembayaran->nomor_anggota_asasi }}</td></tr>
                        @endif
                    </table>
                </div>
            </td>
            <td class="info-gap"></td>
            <td class="info-col">
                <div class="card-box">
                    <div class="card-header">Detail Invoice</div>
                    <table class="table-card-inner">
                        <tr><td class="lbl">No. Invoice</td><td class="val">{{ $nomorInvoice }}</td></tr>
                        <tr><td class="lbl">Tgl. Upload</td><td class="val">{{ $pembayaran->created_at->format('d M Y') }}</td></tr>
                        <tr><td class="lbl">Tgl. Dibuat</td><td class="val">{{ now()->format('d M Y') }}</td></tr>
                        <tr><td class="lbl">Status</td><td class="val">{{ $statusLabel }}</td></tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    {{-- ══════════ RINCIAN PEMBAYARAN ══════════ --}}
    <div class="section-title">Rincian Pembayaran</div>
    <table class="table-detail">
        <thead>
            <tr>
                <th style="width: 6%; text-align: center;">#</th>
                <th style="width: 44%;">Deskripsi</th>
                <th style="width: 26%;">Kategori</th>
                <th style="width: 24%; text-align: right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">1</td>
                <td>Biaya Registrasi STARNAS ASASI &amp; ICoABCD 2026</td>
                <td>{{ $kategoriLabel }}</td>
                <td style="text-align: right; font-weight: bold;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- ══════════ TOTAL PEMBAYARAN ══════════ --}}
    <table class="table-total-wrap">
        <tr>
            <td style="width: 45%;"></td>
            <td style="width: 55%;">
                <table class="total-box">
                    <tr>
                        <td class="total-label">Total Pembayaran</td>
                        <td class="total-amount">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- ══════════ INFORMASI REKENING TRANSFER ══════════ --}}
    <table class="table-rekening-wrap">
        <tr>
            <td>
                <div class="rekening-title">&#9432; Informasi Rekening Tujuan Transfer</div>
                <table class="table-rekening-inner">
                    <tr>
                        <td class="rek-lbl">Bank</td>
                        <td class="rek-val">Bank Syariah Indonesia (BSI)</td>
                    </tr>
                    <tr>
                        <td class="rek-lbl">Nomor Rekening</td>
                        <td class="rek-val">1912749480</td>
                    </tr>
                    <tr>
                        <td class="rek-lbl">Atas Nama</td>
                        <td class="rek-val">Abdul Hadi Kadarusno</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- ══════════ FOOTER (KONFIRMASI VIA WA SAJA, TANPA EMAIL) ══════════ --}}
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem STARNAS pada {{ now()->format('d M Y, H:i') }} WIB.</p>
        <p>Invoice ini <strong>bukan</strong> merupakan bukti pembayaran yang sah &mdash; simpan bukti transfer asli Anda.</p>
        <p class="wa-contact">
            Konfirmasi &amp; Pertanyaan langsung via WhatsApp: +62 812-2729-039
        </p>
    </div>

</body>
</html>
