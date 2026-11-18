<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $nomorInvoice }}</title>
    <style>
        @page {
            margin: 35px 45px 35px 45px;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9.5pt;
            color: #1f2937;
            background: #ffffff;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* ===== WATERMARK ===== */
        .watermark {
            position: fixed;
            top: 38%;
            left: 5%;
            right: 5%;
            text-align: center;
            transform: rotate(-30deg);
            font-size: 42pt;
            font-weight: bold;
            letter-spacing: 5px;
            opacity: 0.05;
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
            border-bottom: 2.5px solid #059669;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }
        .table-header td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }
        .col-logo {
            width: 80px;
        }
        .col-logo img {
            width: 72px;
            height: auto;
        }
        .col-header-text {
            padding-left: 14px;
        }
        .col-header-text h1 {
            font-size: 14pt;
            font-weight: bold;
            color: #064e3b;
            margin: 0;
            line-height: 1.25;
            letter-spacing: 0.3px;
        }
        .col-header-text .event-sub {
            font-size: 9pt;
            color: #4b5563;
            margin-top: 3px;
            line-height: 1.3;
        }
        .col-header-text .event-venue {
            font-size: 8.5pt;
            color: #6b7280;
            margin-top: 2px;
            line-height: 1.3;
        }
        .col-inv {
            width: 180px;
            text-align: right;
        }
        .col-inv .inv-title {
            font-size: 22pt;
            font-weight: bold;
            color: #059669;
            letter-spacing: 2px;
            line-height: 1;
        }
        .col-inv .inv-num {
            font-size: 8.5pt;
            color: #6b7280;
            margin-top: 5px;
            font-weight: 500;
        }

        /* ===== STATUS BADGE ===== */
        .status-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .badge {
            display: inline-block;
            padding: 5px 22px;
            border-radius: 20px;
            font-size: 8.5pt;
            font-weight: bold;
            letter-spacing: 1.2px;
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
            margin-bottom: 22px;
        }
        .table-info-wrap td.info-col {
            vertical-align: top;
            width: 48%;
            padding: 0;
        }
        .table-info-wrap td.info-gap {
            width: 4%;
            padding: 0;
        }

        .card-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
        }
        .card-header {
            font-size: 8.5pt;
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1.5px solid #cbd5e1;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }
        .table-card-inner {
            width: 100%;
            border-collapse: collapse;
        }
        .table-card-inner td {
            padding: 3px 0;
            font-size: 8.5pt;
            vertical-align: top;
            border: none;
            line-height: 1.4;
        }
        .table-card-inner td.lbl {
            width: 38%;
            color: #64748b;
            padding-right: 6px;
        }
        .table-card-inner td.val {
            width: 62%;
            color: #0f172a;
            font-weight: 600;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 9pt;
            font-weight: bold;
            color: #065f46;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }

        /* ===== DETAIL TABLE ===== */
        .table-detail {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .table-detail thead tr {
            background: #059669;
            color: #ffffff;
        }
        .table-detail thead th {
            padding: 9px 12px;
            text-align: left;
            font-size: 8.5pt;
            font-weight: bold;
            color: #ffffff;
            border: none;
            letter-spacing: 0.3px;
        }
        .table-detail tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }
        .table-detail tbody td {
            padding: 12px 12px;
            font-size: 9pt;
            color: #334155;
            vertical-align: middle;
            border: none;
            border-bottom: 1px solid #e2e8f0;
        }

        /* ===== TOTAL SUMMARY ===== */
        .table-total-wrap {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 22px;
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
            border-radius: 8px;
        }
        .total-box td {
            padding: 11px 16px;
            vertical-align: middle;
        }
        .total-box .total-label {
            color: #065f46;
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .total-box .total-amount {
            text-align: right;
            color: #065f46;
            font-size: 13.5pt;
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
            border-radius: 8px;
            margin-bottom: 22px;
        }
        .table-rekening-wrap td {
            padding: 12px 16px;
            border: none;
        }
        .rekening-title {
            font-size: 8.5pt;
            font-weight: bold;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 6px;
        }
        .table-rekening-inner {
            width: 100%;
            border-collapse: collapse;
        }
        .table-rekening-inner td {
            padding: 3px 0;
            font-size: 8.5pt;
            border: none;
        }
        .table-rekening-inner td.rek-lbl {
            width: 115px;
            color: #78350f;
        }
        .table-rekening-inner td.rek-val {
            color: #1e293b;
            font-weight: bold;
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 7.5pt;
            line-height: 1.6;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
            margin-top: 8px;
        }
        .footer .wa-contact {
            margin-top: 4px;
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
                <p class="event-sub">Seminar Nasional &amp; International Conference</p>
                <p class="event-venue">1 &ndash; 2 Desember 2026 &bull; The Malioboro Hotel, Yogyakarta</p>
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
            <td style="width: 42%;"></td>
            <td style="width: 58%;">
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
                <div class="rekening-title">Informasi Rekening Tujuan Transfer</div>
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
