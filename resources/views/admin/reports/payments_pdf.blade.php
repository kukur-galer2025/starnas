<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran STARNAS</title>
    <style>
        @page { size: A4 landscape; margin: 1.5cm 1cm; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 8.5pt; color: #2c3e50; }

        .header { width: 100%; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 4px solid #059669; }
        .header td { border: none; padding: 0; vertical-align: middle; }
        .logo img { max-width: 70px; height: auto; }
        .title { text-align: right; }
        .title h1 { margin: 0; font-size: 14pt; color: #064e3b; }
        .title p { margin: 4px 0 0; font-size: 8.5pt; color: #555; }

        .filter { background: #f0fdf4; border: 1px solid #bbf7d0; padding: 6px 10px; margin-bottom: 10px; font-size: 8pt; color: #166534; }

        table.data { width: 100%; border-collapse: collapse; }
        table.data th, table.data td { border-bottom: 1px solid #e5e7eb; padding: 6px 6px; text-align: left; vertical-align: top; }
        table.data th { background: #f1f5f9; font-size: 7.5pt; text-transform: uppercase; }
        table.data tr:nth-child(even) td { background: #f8fafc; }
        .r { text-align: right !important; }
        .c { text-align: center !important; }

        .verified { color: #15803d; font-weight: bold; }
        .pending { color: #b45309; font-weight: bold; }
        .rejected { color: #b91c1c; font-weight: bold; }

        .total td { background: #ecfdf5 !important; border-top: 3px solid #059669; font-weight: bold; font-size: 10pt; padding: 9px 6px; }

        .footer { position: fixed; bottom: 0.4cm; right: 1cm; font-size: 7.5pt; color: #888; }
    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td class="logo" style="width: 12%;">
                @if($logoUrl)<img src="{{ $logoUrl }}" alt="Logo">@endif
            </td>
            <td class="title">
                <h1>LAPORAN PEMBAYARAN PESERTA<br>STARNAS ASASI &amp; ICoABCD 2026</h1>
                <p>Dicetak: {{ now()->translatedFormat('d F Y H:i') }} WIB &middot; {{ $payments->count() }} data</p>
            </td>
        </tr>
    </table>

    @if(count($filter))
        <div class="filter"><strong>Filter:</strong> {{ implode('  |  ', $filter) }}</div>
    @endif

    @php
        $lebarTotal = array_sum(array_map(fn ($k) => $kolomList[$k][1], $kolomDipilih));
        $idxNominal = array_search('nominal', $kolomDipilih);
        $totalNominal = $payments->sum('nominal');
    @endphp

    <table class="data">
        <thead>
            <tr>
                <th class="c" style="width: 3%;">No</th>
                @foreach($kolomDipilih as $k)
                    <th class="{{ $k === 'nominal' ? 'r' : '' }}" style="width: {{ round($kolomList[$k][1] / $lebarTotal * 97, 1) }}%;">{{ $kolomList[$k][0] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $i => $p)
                <tr>
                    <td class="c">{{ $i + 1 }}</td>
                    @foreach($kolomDipilih as $k)
                        @if($k === 'nominal')
                            <td class="r"><strong>Rp {{ number_format($p->nominal, 0, ',', '.') }}</strong></td>
                        @elseif($k === 'status')
                            <td><span class="{{ $p->status }}">{{ $p->labelStatus() }}</span></td>
                        @else
                            <td>{{ $nilai($p, $k) }}</td>
                        @endif
                    @endforeach
                </tr>
            @empty
                <tr><td colspan="{{ count($kolomDipilih) + 1 }}" class="c" style="padding: 20px;">Tidak ada data.</td></tr>
            @endforelse

            @if($idxNominal !== false && $payments->count())
                <tr class="total">
                    <td colspan="{{ $idxNominal + 1 }}" class="r">TOTAL</td>
                    <td class="r">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                    @if(count($kolomDipilih) - $idxNominal - 1 > 0)
                        <td colspan="{{ count($kolomDipilih) - $idxNominal - 1 }}"></td>
                    @endif
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">Dokumen rahasia - dibuat otomatis oleh Sistem Administrasi STARNAS ASASI &amp; ICoABCD 2026</div>
</body>
</html>
