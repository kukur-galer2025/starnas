@extends('admin.layouts.app')

@section('title', 'Laporan Pembayaran')

@section('content')
    @php
        $statusDipilih = (array) request('status', []);
        $kategoriDipilih = (array) request('kategori', []);
        $adaFilter = request()->hasAny(['search', 'status', 'kategori', 'dari', 'sampai']);
        $totalNominal = $payments->sum('nominal');
    @endphp

    <form id="form-laporan" action="{{ route('admin.reports.payments.index') }}" method="GET" class="space-y-6">

        {{-- FILTER --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-5 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-800"><i class="fas fa-filter text-emerald-600 mr-2"></i>Filter Data</h3>
                @if($adaFilter)
                    <a href="{{ route('admin.reports.payments.index') }}" class="text-xs font-semibold text-red-600 hover:underline"><i class="fas fa-xmark mr-1"></i>Reset semua filter</a>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Cari peserta</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, email, no. HP, atau institusi"
                            class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-400">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Tanggal upload dari</label>
                            <input type="date" name="dari" value="{{ request('dari') }}" class="w-full h-11 px-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-400">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Sampai</label>
                            <input type="date" name="sampai" value="{{ request('sampai') }}" class="w-full h-11 px-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Urutkan</label>
                        <select name="urut" class="w-full h-11 px-3 text-sm rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-emerald-400">
                            @foreach(['terlama' => 'Tanggal upload (terlama dulu)', 'terbaru' => 'Tanggal upload (terbaru dulu)', 'nama' => 'Nama peserta (A-Z)', 'nominal' => 'Nominal (terbesar)'] as $v => $l)
                                <option value="{{ $v }}" @selected(request('urut', 'terlama') === $v)>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Status</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach(\App\Models\Pembayaran::STATUS as $v => $l)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="status[]" value="{{ $v }}" class="peer sr-only" @checked(in_array($v, $statusDipilih))>
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm border border-slate-200 text-slate-600 peer-checked:bg-emerald-600 peer-checked:border-emerald-600 peer-checked:text-white transition">{{ $l }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach(\App\Models\Pembayaran::KATEGORI as $v => $l)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="kategori[]" value="{{ $v }}" class="peer sr-only" @checked(in_array($v, $kategoriDipilih))>
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs border border-slate-200 text-slate-600 peer-checked:bg-emerald-600 peer-checked:border-emerald-600 peer-checked:text-white transition">{{ $l }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1.5">Kosongkan pilihan = tampilkan semua.</p>
                    </div>
                </div>
            </div>

            {{-- Kolom --}}
            <details class="mt-5 group" @if(request()->has('kolom')) open @endif>
                <summary class="cursor-pointer text-sm font-semibold text-slate-700 select-none">
                    <i class="fas fa-table-columns text-emerald-600 mr-2"></i>Pilih kolom yang dicetak
                    <span class="text-xs font-normal text-slate-400 ml-1">({{ count($kolomDipilih) }} kolom)</span>
                </summary>
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach($kolomList as $key => [$label])
                        <label class="cursor-pointer">
                            <input type="checkbox" name="kolom[]" value="{{ $key }}" class="peer sr-only" @checked(in_array($key, $kolomDipilih))>
                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm border border-slate-200 text-slate-500 peer-checked:bg-slate-800 peer-checked:border-slate-800 peer-checked:text-white transition">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </details>

            <div class="mt-5 flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 h-11 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold">
                    <i class="fas fa-magnifying-glass"></i> Terapkan Filter
                </button>
            </div>
        </div>

        {{-- HASIL + EXPORT --}}
        <div class="bg-white rounded-2xl border border-slate-200">
            <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-3 p-4 md:p-5 border-b border-slate-100">
                <div>
                    <p class="font-semibold text-slate-800">{{ $payments->count() }} data <span class="text-slate-400 font-normal">dari {{ $totalSemua }} total</span></p>
                    <p class="text-sm text-slate-500">Total nominal: <strong class="text-emerald-700">Rp {{ number_format($totalNominal, 0, ',', '.') }}</strong>
                        <span class="text-slate-400">&middot; terverifikasi Rp {{ number_format($totalVerified, 0, ',', '.') }}</span></p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span id="info-pilih" class="text-xs text-slate-500 mr-1">Semua data akan diekspor</span>
                    <button type="button" data-export="{{ route('admin.reports.payments.export-pdf') }}" data-tampil="1"
                        class="btn-export inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                    <button type="button" data-export="{{ route('admin.reports.payments.export-pdf') }}"
                        class="btn-export inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                    <button type="button" data-export="{{ route('admin.reports.payments.export-excel') }}"
                        class="btn-export inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold">
                        <i class="fas fa-file-excel"></i> Excel
                    </button>
                </div>
            </div>

            @if($payments->isEmpty())
                <div class="p-12 text-center text-slate-400">
                    <i class="fas fa-folder-open text-3xl mb-2 block"></i>
                    {{ $adaFilter ? 'Tidak ada data yang cocok dengan filter ini.' : 'Belum ada data pembayaran.' }}
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="pl-5 pr-2 py-3 w-10">
                                    <input type="checkbox" id="pilih-semua" class="w-4 h-4 rounded accent-emerald-600" title="Pilih semua baris">
                                </th>
                                <th class="px-3 py-3">No</th>
                                @foreach($kolomDipilih as $k)
                                    <th class="px-4 py-3 {{ $k === 'nominal' ? 'text-right' : '' }}">{{ $kolomList[$k][0] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($payments as $i => $p)
                                <tr class="hover:bg-slate-50">
                                    <td class="pl-5 pr-2 py-3">
                                        <input type="checkbox" value="{{ $p->id }}" class="pilih-baris w-4 h-4 rounded accent-emerald-600">
                                    </td>
                                    <td class="px-3 py-3 text-slate-400">{{ $i + 1 }}</td>
                                    @foreach($kolomDipilih as $k)
                                        @php
                                            $val = match($k) {
                                                'nama' => $p->user->nama_lengkap ?? '-',
                                                'email' => $p->user->email ?? '-',
                                                'hp' => $p->user->nomor_handphone ?: '-',
                                                'institusi' => $p->user->institusi ?: '-',
                                                'kategori' => $p->labelKategori(),
                                                'nominal' => 'Rp ' . number_format($p->nominal, 0, ',', '.'),
                                                'tgl_upload' => $p->created_at->format('d/m/Y'),
                                                'tgl_verifikasi' => $p->status === 'verified' ? $p->updated_at->format('d/m/Y') : '-',
                                                'catatan' => $p->catatan_admin ?: '-',
                                                default => '',
                                            };
                                        @endphp
                                        <td class="px-4 py-3 {{ $k === 'nominal' ? 'text-right font-semibold text-emerald-700 whitespace-nowrap' : 'text-slate-700' }} {{ $k === 'nama' ? 'font-medium text-slate-900' : '' }}">
                                            @if($k === 'status')
                                                @php $cls = ['pending' => 'bg-amber-100 text-amber-700', 'verified' => 'bg-emerald-100 text-emerald-700', 'rejected' => 'bg-red-100 text-red-700'][$p->status] ?? 'bg-slate-100 text-slate-600'; @endphp
                                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $cls }}">{{ $p->labelStatus() }}</span>
                                            @else
                                                {{ $val }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        @if(in_array('nominal', $kolomDipilih))
                        <tfoot>
                            <tr class="bg-emerald-50/70 font-bold">
                                <td colspan="{{ 2 + array_search('nominal', $kolomDipilih) }}" class="px-5 py-4 text-right text-slate-700">Total</td>
                                <td class="px-4 py-4 text-right text-emerald-800 whitespace-nowrap">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                                <td colspan="{{ max(count($kolomDipilih) - array_search('nominal', $kolomDipilih) - 1, 0) }}"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            @endif
        </div>
    </form>
@endsection

@push('scripts')
<script>
    (function () {
        var form = document.getElementById('form-laporan');
        var semua = document.getElementById('pilih-semua');
        var info = document.getElementById('info-pilih');
        var baris = function () { return Array.prototype.slice.call(document.querySelectorAll('.pilih-baris')); };

        function perbarui() {
            var n = baris().filter(function (c) { return c.checked; }).length;
            info.textContent = n > 0 ? n + ' baris dipilih akan diekspor' : 'Semua data akan diekspor';
            if (semua) semua.checked = n > 0 && n === baris().length;
        }

        if (semua) semua.addEventListener('change', function () {
            baris().forEach(function (c) { c.checked = semua.checked; });
            perbarui();
        });
        baris().forEach(function (c) { c.addEventListener('change', perbarui); });

        // Export memakai filter yang sedang aktif di halaman (bukan isi form yang belum diterapkan).
        document.querySelectorAll('.btn-export').forEach(function (b) {
            b.addEventListener('click', function () {
                var params = new URLSearchParams(window.location.search);
                params.delete('ids[]');
                baris().filter(function (c) { return c.checked; }).forEach(function (c) { params.append('ids[]', c.value); });
                if (b.dataset.tampil) params.set('tampil', '1');
                var url = b.dataset.export + '?' + params.toString();
                if (b.dataset.tampil) { window.open(url, '_blank'); } else { window.location.href = url; }
            });
        });

        perbarui();
    })();
</script>
@endpush
