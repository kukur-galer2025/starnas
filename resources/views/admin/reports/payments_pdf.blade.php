<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran STARNAS</title>
    
    <style>
        @page {
            size: A4 landscape;
            margin: 1.5cm 1cm; /* Margin atas/bawah ditingkatkan */
        }
        body { 
            font-family: 'Poppins', Arial, sans-serif; /* Menggunakan font yang lebih modern jika tersedia */
            font-size: 9.5pt; 
            color: #2c3e50; /* Warna teks gelap */
        }
        
        /* HEADER DENGAN LOGO */
        .header-container {
            /* Penting: Menggunakan display: table untuk tata letak yang konsisten di PDF */
            display: table; 
            width: 100%;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 4px solid #059669; /* Garis bawah tebal */
        }
        .logo {
            display: table-cell;
            width: 10%;
            text-align: left;
            vertical-align: middle;
        }
        .logo img {
            max-width: 80px; /* Ukuran Logo sedikit dibesarkan */
            height: auto;
        }
        .title-block {
            display: table-cell;
            width: 90%;
            text-align: right; /* Rata kanan agar kontras dengan logo */
            vertical-align: middle;
        }
        .title-block h1 { 
            margin: 0; 
            font-size: 18pt; /* Lebih besar */
            color: #064e3b;
            font-weight: 800; /* Ekstra bold */
        }
        .title-block p { 
            margin: 5px 0 0; 
            font-size: 10pt; 
            color: #555;
            font-weight: 500;
        }
        
        /* TABLE STYLING */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
        }
        th, td { 
            border: none;
            border-bottom: 1px solid #e0e0e0; 
            padding: 9px 8px; /* Padding lebih besar */
            text-align: left;
            vertical-align: middle;
        }
        th { 
            background-color: #f8f9fa; /* Latar belakang header lebih terang */
            color: #2c3e50;
            font-size: 9pt;
            text-transform: uppercase;
            font-weight: 700;
        }
        
        /* Data Row Hover Effect (Visualisasi) */
        tr:nth-child(even) {
            background-color: #f7f9fd; /* Baris genap sedikit lebih gelap */
        }

        /* Pewarnaan Status */
        .status-verified { color: #28a745; font-weight: bold; }
        .status-pending { color: #ffc107; font-weight: bold; }
        .status-rejected { color: #dc3545; font-weight: bold; }
        
        /* Total */
        .total-row td {
            background-color: #ecfdf5;
            font-weight: 700;
            border-top: 3px solid #059669 !important;
            border-bottom: none;
            padding: 12px 8px;
        }
        .total-label {
            font-size: 12pt;
            color: #064e3b;
            text-align: right;
        }
        .total-nominal-value {
            font-size: 16pt;
            color: #dc3545; /* Warna kontras untuk nominal total */
            font-weight: 900;
        }

        .footer { 
            position: fixed;
            bottom: 0.5cm;
            right: 1cm;
            font-size: 8pt; 
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <div class="logo">
            {{-- PERBAIKAN: Menggunakan variabel $logoUrl yang dikirim dari controller --}}
            <img src="{{ $logoUrl }}" alt="Logo STARNAS">
        </div>
        <div class="title-block">
            <h1>LAPORAN DATA PEMBAYARAN PESERTA STARNAS ASASI & ICoABCD 2026</h1>
            <p>Tanggal Ekspor: {{ date('d F Y H:i:s') }} WIB</p>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th style="width: 3%; text-align: center;">No.</th>
                <th style="width: 14%;">Nama Peserta</th>
                <th style="width: 18%;">Email / No. WA</th>
                <th style="width: 10%;">Kategori</th>
                <th style="width: 9%; text-align: right;">Nominal</th>
                <th style="width: 8%; text-align: center;">Status</th>
                <th style="width: 8%; text-align: center;">Tgl Verifikasi</th>
                <th style="width: 20%;">Catatan Admin</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalNominal = 0;
            @endphp
            @foreach($payments as $index => $payment)
                @php
                    $totalNominal += $payment->nominal;
                    
                    $kategori = match($payment->kategori_pembayaran) {
                        'asasi' => 'Anggota ASASI',
                        'umum' => 'Umum',
                        'mahasiswa' => 'Mahasiswa',
                        'non-presenter' => 'Non Presenter',
                        default => ucfirst($payment->kategori_pembayaran),
                    };
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $payment->user->nama_lengkap }}</td>
                    <td>
                        {{ $payment->user->email }}
                        @if($payment->user->nomor_handphone)
                            <br><span style="font-size: 8.5pt; color: #059669;">{{ $payment->user->nomor_handphone }}</span>
                        @endif
                    </td>
                    <td>{{ $kategori }}</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($payment->nominal, 0, ',', '.') }}</td>
                    <td style="text-align: center; font-size: 8pt;">
                        @if ($payment->status == 'verified')
                            <span class="status-verified">{{ ucfirst($payment->status) }}</span>
                        @elseif ($payment->status == 'pending')
                            <span class="status-pending">{{ ucfirst($payment->status) }}</span>
                        @else
                            <span class="status-rejected">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $payment->status == 'verified' ? $payment->updated_at->format('d/m/Y') : '-' }}</td>
                    <td>{{ $payment->catatan_admin ?? '-' }}</td>
                </tr>
            @endforeach
            
            {{-- BARIS TOTAL KESELURUHAN --}}
            <tr class="total-row">
                {{-- Gabung kolom 1 sampai 4 untuk Label --}}
                <td colspan="4" class="total-label" style="text-align: right; padding-right: 20px; color: #2c3e50;">TOTAL KESELURUHAN NOMINAL:</td>
                
                {{-- Kolom Nominal Total (Gabung kolom 5-8) --}}
                <td colspan="4" class="total-nominal-value" style="text-align: left; padding-left: 20px; color: #dc3545; font-weight: 900;">
                    Rp {{ number_format($totalNominal, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Laporan ini bersifat rahasia dan dibuat otomatis oleh Sistem Administrasi STARNAS ASASI & ICoABCD 2026.
    </div>
</body>
</html>