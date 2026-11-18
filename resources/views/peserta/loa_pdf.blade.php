<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Letter of Acceptance - {{ $idNaskah }}</title>
    <style>
        @page { margin: 3.4cm 2.5cm 2.6cm 2.5cm; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000;
        }

        /* Kop surat & footer berulang di setiap halaman */
        .kop {
            position: fixed;
            top: -2.8cm; left: 0; right: 0;
            height: 90px;
        }
        .kop table { width: 100%; border-collapse: collapse; }
        .kop td { vertical-align: middle; }
        .kop .logo-kiri { width: 25%; text-align: left; }
        .kop .logo-kanan { width: 25%; text-align: right; }
        .kop .judul { width: 50%; text-align: center; font-weight: bold; }
        .kop .judul .nama { font-size: 12pt; }
        .kop .judul .sub { font-size: 9pt; }

        .kaki {
            position: fixed;
            bottom: -2cm; left: 0; right: 0;
            text-align: center;
        }
        .kaki .nama { font-size: 9pt; font-weight: bold; }
        .kaki .tema { font-size: 12pt; font-style: italic; }

        h1 {
            text-align: center;
            font-size: 16pt;
            margin: 0;
            letter-spacing: 0.3px;
        }
        .nomor { text-align: center; margin: 4px 0 22px; }

        p { margin: 0 0 10px; }
        .justify { text-align: justify; }

        table.data { border-collapse: collapse; margin: 4px 0 10px; }
        table.data td { padding: 2px 0; vertical-align: top; }
        table.data td.label { width: 105px; font-weight: bold; }

        .ttd { margin-top: 18px; }
        .ttd img { width: 160px; margin: 4px 0 2px -6px; }
        .ttd .nama-ketua { font-weight: bold; }
    </style>
</head>
<body>
    <div class="kop">
        <table>
            <tr>
                <td class="logo-kiri">
                    @if($logoStarnas)<img src="{{ $logoStarnas }}" style="height: 62px;">@endif
                </td>
                <td class="judul">
                    <div class="nama">STARNAS ASASI 2026</div>
                    <div class="sub">Seminar Teknologi dan Sains Nasional ASASI</div>
                    <div class="sub">1&ndash;2 Desember 2026 | Yogyakarta</div>
                </td>
                <td class="logo-kanan">
                    @if($logoAsasi)<img src="{{ $logoAsasi }}" style="height: 52px;">@endif
                </td>
            </tr>
        </table>
    </div>

    <div class="kaki">
        <div class="nama">STARNAS ASASI 2026</div>
        <div class="tema">AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi</div>
    </div>

    <h1>LETTER OF ACCEPTANCE</h1>
    <div class="nomor">Nomor {{ $nomorSurat }}</div>

    <p>
        Yth. {{ $namaPenulis }}<br>
        {{ $afiliasi }}
    </p>

    <p>Dengan hormat,</p>

    <p>
        Panitia Seminar Teknologi dan Sains Nasional ASASI (STARNAS ASASI 2026) menyampaikan bahwa
        naskah berikut telah diterima untuk dipresentasikan pada seminar yang diselenggarakan pada
        1&ndash;2 Desember 2026 di Yogyakarta.
    </p>

    <table class="data">
        <tr>
            <td class="label">ID Naskah</td>
            <td>{{ $idNaskah }}</td>
        </tr>
        <tr>
            <td class="label">Judul Naskah</td>
            <td>{{ $judulNaskah }}</td>
        </tr>
        <tr>
            <td class="label">Penulis</td>
            <td>{{ $penulis }}</td>
        </tr>
    </table>

    <p>Informasi mengenai jadwal dan sesi presentasi akan disampaikan oleh panitia.</p>

    <div class="ttd">
        Hormat kami,<br>
        Yogyakarta, {{ $tanggalSurat }}<br>
        Ketua Panitia STARNAS ASASI 2026<br>
        @if($ttdKetua)<img src="{{ $ttdKetua }}">@else<div style="height: 90px;"></div>@endif
        <div class="nama-ketua">Dr. Ahmad Zaki</div>
    </div>
</body>
</html>
