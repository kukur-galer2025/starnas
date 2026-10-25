<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran {{ $pembayaran->user->nama_lengkap }}</title>
    <style>
        /* BASE STYLES */
        body {
            font-family: Arial, sans-serif;
            color: #2c3e50;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 750px;
            margin: 30px auto;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 40px;
            position: relative;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        /* TOP BORDER (ELEGANT LINE) */
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: #059669; 
            border-radius: 12px 12px 0 0;
        }
        
        /* HEADER SECTION */
        .header-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .header-table .header-text {
            text-align: left;
            padding-left: 20px;
        }
        .logo-image {
            width: 80px; 
            height: auto;
            object-fit: contain;
        }
        
        .header h1 {
            margin: 0 0 5px 0;
            color: #064e3b;
            font-size: 28px;
            font-weight: 700;
        }
        .header .subtitle {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
            font-weight: 500;
        }
        
        /* STAMP LUNAS (PAID) */
        .paid-stamp {
            position: absolute;
            top: 150px;
            right: 40px;
            color: #059669;
            font-size: 32px;
            font-weight: bold;
            border: 4px solid #059669;
            padding: 10px 20px;
            border-radius: 10px;
            opacity: 0.7;
            transform: rotate(-15deg);
            z-index: 10;
        }
        
        /* WATERMARK */
        .watermark {
            position: absolute;
            top: 30%;
            left: 5%;
            opacity: 0.05;
            font-size: 150px;
            font-weight: bold;
            color: #059669;
            transform: rotate(-45deg);
            z-index: 0;
        }
        
        /* INFO TABLE (LEFT BLOCK) */
        .info-table {
            width: 100%;
            margin-bottom: 30px;
            font-size: 15px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 5px 0;
        }
        .info-table .label {
            width: 150px;
            font-weight: 600;
            color: #34495e;
        }
        .info-table .value {
            color: #2c3e50;
            font-weight: 500;
            padding-left: 10px;
        }
        
        /* DETAILS TABLE */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        .details-table th {
            background-color: #f0fdf4;
            color: #064e3b;
            font-size: 14px;
            font-weight: 700;
            text-transform: none; 
            padding: 12px 16px;
            border-top: 2px solid #059669;
            border-bottom: 2px solid #059669;
        }
        .details-table td {
            font-size: 14px;
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
        }
        
        /* TOTAL ROW */
        .total-row {
            font-size: 18px;
            font-weight: bold;
            background-color: #ecfdf5; 
            color: #064e3b;
        }
        .total-row td {
            border-top: 2px solid #059669;
            padding: 15px 16px;
        }
        .total-amount {
            font-size: 24px;
            font-weight: 900;
            color: #059669; 
        }
        
        /* FOOTER & VALIDASI */
        .validation-block {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }
        .admin-note {
            width: 70%;
            float: left;
            padding-right: 20px;
        }
        .validation-info {
            width: 30%;
            float: right;
            text-align: center;
        }
        .validation-stamp {
            margin-top: 10px;
            font-size: 11px;
            color: #27ae60;
            font-weight: bold;
            border: 1px solid #27ae60;
            padding: 5px;
            display: inline-block;
        }
        .footer-system {
            clear: both;
            margin-top: 60px;
            font-size: 10px;
            color: #7f8c8d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        
        @if ($pembayaran->status == 'verified')
            <div class="paid-stamp">LUNAS</div>
        @endif
        
        <div class="watermark">KWITANSI</div>

        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="header-logo" style="width: 120px;">
                        {{-- PERBAIKAN: Menggunakan $logoUrl yang dikirim dari Controller --}}
                        <img src="{{ $logoUrl }}" alt="Logo STARNAS ASASI" class="logo-image">
                    </td>
                    <td class="header-text">
                        <h1>KWITANSI PEMBAYARAN</h1>
                        <p class="subtitle">Seminar Teknologi dan Sains Nasional</p>
                        <p class="subtitle">Diselenggarakan oleh ASASI</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content">
            <table class="info-table">
                <tr>
                    <td class="label">ID Kwitansi</td>
                    <td class="value">: <strong style="color:#059669;">PMT-{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Diterima Dari</td>
                    <td class="value">: 
                        <strong style="color: #34495e;">{{ $pembayaran->user->nama_lengkap }}</strong> 
                        ({{ $pembayaran->user->email }})
                        @if ($pembayaran->user->nomor_handphone)
                            <br><span>No. HP: {{ $pembayaran->user->nomor_handphone }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Untuk Pembayaran</td>
                    <td class="value">: Biaya Pendaftaran STARNAS ASASI & ICoABCD 2026</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Verifikasi</td>
                    <td class="value">: {{ $pembayaran->updated_at->format('d F Y') }}</td>
                </tr>
            </table>

            <table class="details-table">
                <thead>
                    <tr>
                        <th style="width: 70%;">Deskripsi</th>
                        <th style="width: 30%; text-align: right;">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Biaya Pendaftaran Kategori: 
                            <strong style="color: #059669;">
                                @switch($pembayaran->kategori_pembayaran)
                                    @case('asasi') Anggota ASASI @break
                                    @case('umum') Umum @break
                                    @case('mahasiswa') Mahasiswa @break
                                    @case('non-presenter') Non Presenter @break
                                    @default {{ ucfirst($pembayaran->kategori_pembayaran) }}
                                @endswitch
                            </strong>
                            @if($pembayaran->nomor_anggota_asasi)
                                <br><small style="color: #7f8c8d;">(No. Anggota: {{ $pembayaran->nomor_anggota_asasi }})</small>
                            @endif
                        </td>
                        <td style="text-align: right;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="total-row">
                        <td style="text-align: right; font-weight: 700;">TOTAL DIBAYARKAN</td>
                        <td class="total-amount" style="text-align: right;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <div class="validation-block">
                <div class="admin-note">
                    <strong style="color: #059669; font-size: 14px;">Catatan Admin:</strong>
                    <p style="margin-top: 5px; font-size: 13px;">{{ $pembayaran->catatan_admin ?? 'Pembayaran telah dikonfirmasi dan pendaftaran disetujui.' }}</p>
                </div>
                
                <div class="validation-info">
                    <p style="margin: 0; font-weight: 600;">STATUS KWITANSI</p>
                    <p class="validation-stamp">TERVALIDASI SISTEM</p>
                    <p style="margin-top: 10px; font-size: 12px; color: #34495e;">Jakarta, {{ $pembayaran->updated_at->format('d F Y') }}</p>
                </div>
            </div>
            
            <div class="footer-system">
                Kwitansi ini sah dan diterbitkan secara otomatis oleh sistem. Tidak memerlukan tanda tangan basah. Dicetak pada {{ now()->format('d M Y, H:i') }} WIB.
            </div>
        </div>
    </div>
</body>
</html>