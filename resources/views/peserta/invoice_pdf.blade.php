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
            color: #1a1a2e;
            background: #ffffff;
            line-height: 1.5;
        }

        .page {
            width: 100%;
            padding: 30px 40px;
        }

        /* ===== HEADER ===== */
        .header {
            border-bottom: 3px solid #16a34a;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .header-inner {
            display: table;
            width: 100%;
        }
        .header-logo {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }
        .header-logo img {
            width: 72px;
            height: auto;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            padding-left: 14px;
        }
        .header-text h1 {
            font-size: 18px;
            font-weight: bold;
            color: #15803d;
            letter-spacing: 1px;
        }
        .header-text p {
            font-size: 10px;
            color: #4b5563;
            margin-top: 2px;
        }
        .header-invoice {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 220px;
        }
        .header-invoice .inv-title {
            font-size: 22px;
            font-weight: bold;
            color: #15803d;
            letter-spacing: 2px;
        }
        .header-invoice .inv-number {
            font-size: 10px;
            color: #6b7280;
            margin-top: 3px;
        }

        /* ===== STATUS BADGE ===== */
        .status-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .badge {
            display: inline-block;
            padding: 5px 20px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .badge-pending  { background: #fef9c3; color: #854d0e; border: 1.5px solid #fbbf24; }
        .badge-verified { background: #dcfce7; color: #166534; border: 1.5px solid #16a34a; }
        .badge-rejected { background: #fee2e2; color: #991b1b; border: 1.5px solid #ef4444; }

        /* ===== INFO BOXES ===== */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 18px;
            border-spacing: 10px 0;
        }
        .info-box {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 14px;
        }
        .info-box h4 {
            font-size: 10px;
            font-weight: bold;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #d1fae5;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }
        .info-box table { width: 100%; border-collapse: collapse; }
        .info-box table td {
            padding: 2px 0;
            font-size: 10.5px;
            vertical-align: top;
        }
        .info-box table td:first-child {
            color: #6b7280;
            width: 42%;
            padding-right: 6px;
        }
        .info-box table td:last-child { color: #111827; font-weight: 600; }

        /* ===== DETAIL TABLE ===== */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .detail-table thead tr {
            background: #15803d;
            color: #ffffff;
        }
        .detail-table thead th {
            padding: 8px 12px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .detail-table tbody tr { border-bottom: 1px solid #e5e7eb; }
        .detail-table tbody tr:nth-child(even) { background: #f9fafb; }
        .detail-table tbody td {
            padding: 8px 12px;
            font-size: 10.5px;
            color: #374151;
            vertical-align: top;
        }

        /* ===== TOTAL ===== */
        .total-box {
            text-align: right;
            margin-bottom: 18px;
        }
        .total-inner {
            display: inline-block;
            background: #f0fdf4;
            border: 2px solid #16a34a;
            border-radius: 8px;
            padding: 12px 24px;
            min-width: 240px;
        }
        .total-inner .total-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .total-inner .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #15803d;
            margin-top: 3px;
        }

        /* ===== REKENING ===== */
        .rekening-box {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            border-left: 4px solid #f59e0b;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 18px;
        }
        .rekening-box h4 {
            font-size: 10px;
            font-weight: bold;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .rekening-box table { border-collapse: collapse; }
        .rekening-box table td {
            padding: 2px 10px 2px 0;
            font-size: 10.5px;
        }
        .rekening-box table td:first-child { color: #78350f; width: 100px; }
        .rekening-box table td:last-child { color: #1c1917; font-weight: bold; }

        /* ===== WATERMARK ===== */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            font-size: 72px;
            font-weight: bold;
            opacity: 0.06;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
        }
        .watermark-pending  { color: #d97706; }
        .watermark-verified { color: #16a34a; }
        .watermark-rejected { color: #dc2626; }

        /* ===== FOOTER ===== */
        .footer {
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 9px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- Watermark --}}
    @php
        $wm = $pembayaran->status === 'verified' ? 'TERVERIFIKASI' : ($pembayaran->status === 'rejected' ? 'DITOLAK' : 'BELUM TERVERIFIKASI');
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
        ][$pembayaran->status] ?? $pembayaran->status;
        $badgeClass = 'badge badge-' . $pembayaran->status;
    @endphp
    <div class="{{ $wmClass }}">{{ $wm }}</div>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-inner">
            <div class="header-logo">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="STARNAS Logo">
                @endif
            </div>
            <div class="header-text">
                <h1>STARNAS ASASI & ICoABCD 2026</h1>
                <p>Seminar Nasional & International Conference</p>
                <p>1 - 2 Desember 2026 &bull; The Malioboro Hotel, Yogyakarta</p>
            </div>
            <div class="header-invoice">
                <div class="inv-title">INVOICE</div>
                <div class="inv-number">{{ $nomorInvoice }}</div>
            </div>
        </div>
    </div>

    {{-- STATUS BADGE --}}
    <div class="status-bar">
        <span class="{{ $badgeClass }}">{{ $statusLabel }}</span>
    </div>

    {{-- INFO PESERTA & INVOICE --}}
    <div class="info-row">
        <div class="info-box" style="margin-right:10px;">
            <h4>Data Peserta</h4>
            <table>
                <tr><td>Nama</td><td>{{ $user->nama_lengkap }}</td></tr>
                <tr><td>Email</td><td>{{ $user->email }}</td></tr>
                <tr><td>Institusi</td><td>{{ $user->institusi ?? '-' }}</td></tr>
                <tr><td>No. HP</td><td>{{ $user->nomor_handphone ?? '-' }}</td></tr>
                @if($pembayaran->nomor_anggota_asasi)
                <tr><td>No. Anggota ASASI</td><td>{{ $pembayaran->nomor_anggota_asasi }}</td></tr>
                @endif
            </table>
        </div>
        <div class="info-box">
            <h4>Detail Invoice</h4>
            <table>
                <tr><td>No. Invoice</td><td>{{ $nomorInvoice }}</td></tr>
                <tr><td>Tanggal Upload</td><td>{{ $pembayaran->created_at->format('d M Y') }}</td></tr>
                <tr><td>Tanggal Dibuat</td><td>{{ now()->format('d M Y') }}</td></tr>
                <tr><td>Status</td><td>{{ $statusLabel }}</td></tr>
            </table>
        </div>
    </div>

    {{-- DETAIL PEMBAYARAN --}}
    <div class="section-title">Rincian Pembayaran</div>
    <table class="detail-table">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:40%">Deskripsi</th>
                <th style="width:30%">Kategori Peserta</th>
                <th style="width:25%; text-align:right;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Biaya Registrasi STARNAS ASASI & ICoABCD 2026</td>
                <td>{{ $kategoriLabel }}</td>
                <td style="text-align:right; font-weight:bold;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- TOTAL --}}
    <div class="total-box">
        <div class="total-inner">
            <div class="total-label">Total Pembayaran</div>
            <div class="total-amount">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- REKENING --}}
    <div class="rekening-box">
        <h4>&#9432; Informasi Rekening Tujuan Transfer</h4>
        <table>
            <tr><td>Bank</td><td>Bank Syariah Indonesia (BSI)</td></tr>
            <tr><td>No. Rekening</td><td>1912749480</td></tr>
            <tr><td>Atas Nama</td><td>Abdul Hadi Kadarusno</td></tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem STARNAS pada {{ now()->format('d M Y, H:i') }} WIB.</p>
        <p>Invoice ini bukan merupakan bukti pembayaran yang sah &mdash; simpan bukti transfer asli Anda.</p>
        <p>Pertanyaan: <strong>starnas.asasi2026@gmail.com</strong> &bull; WhatsApp: <strong>+62 852-2551-9882</strong></p>
    </div>

</div>
</body>
</html>
