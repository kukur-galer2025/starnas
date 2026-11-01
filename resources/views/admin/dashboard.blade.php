@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    @php
        $kartu = [
            ['Peserta Terdaftar', $stat['peserta'], '+' . $stat['peserta_baru'] . ' dalam 24 jam', 'fa-users', 'bg-emerald-100 text-emerald-700', route('admin.users.index')],
            ['Abstrak Menunggu', $stat['abstrak_pending'], $stat['abstrak_total'] . ' abstrak masuk', 'fa-file-lines', 'bg-amber-100 text-amber-700', route('admin.abstracts.index')],
            ['Pembayaran Menunggu', $stat['bayar_pending'], $stat['bayar_verified'] . ' sudah terverifikasi', 'fa-money-check-dollar', 'bg-sky-100 text-sky-700', route('admin.payments.index')],
            ['Email Gagal', $stat['email_gagal'], $stat['email_terkirim'] . ' terkirim' . ($stat['email_antri'] ? ', ' . $stat['email_antri'] . ' sedang dikirim' : ''), 'fa-envelope-circle-check', $stat['email_gagal'] ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-600', route('admin.emails.index', $stat['email_gagal'] ? ['status' => 'gagal'] : [])],
        ];
    @endphp

    {{-- Kartu ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 md:gap-6">
        @foreach($kartu as [$label, $angka, $sub, $ikon, $warna, $link])
            <a href="{{ $link }}" class="group bg-white rounded-2xl border border-slate-200 p-5 hover:border-emerald-300 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-500">{{ $label }}</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($angka) }}</p>
                    </div>
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $warna }}">
                        <i class="fas {{ $ikon }}"></i>
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-3 flex items-center justify-between">
                    <span>{{ $sub }}</span>
                    <i class="fas fa-arrow-right text-slate-300 group-hover:text-emerald-600 transition"></i>
                </p>
            </a>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 md:gap-6 mt-6">
        {{-- Perlu tindakan --}}
        <div class="xl:col-span-2 space-y-4 md:space-y-6">
            @foreach([
                ['Abstrak menunggu review', $abstrakMenunggu, 'fa-file-lines', 'admin.abstracts.show', 'admin.abstracts.index'],
                ['Pembayaran menunggu verifikasi', $bayarMenunggu, 'fa-money-check-dollar', 'admin.payments.show', 'admin.payments.index'],
            ] as [$judul, $daftar, $ikon, $routeDetail, $routeIndex])
                <div class="bg-white rounded-2xl border border-slate-200">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800"><i class="fas {{ $ikon }} text-emerald-600 mr-2"></i>{{ $judul }}</h3>
                        <a href="{{ route($routeIndex) }}" class="text-xs font-semibold text-emerald-700 hover:underline">Lihat semua</a>
                    </div>
                    @forelse($daftar as $item)
                        <a href="{{ route($routeDetail, $item->id) }}" class="flex items-center gap-3 px-5 py-3 border-b border-slate-50 last:border-0 hover:bg-slate-50">
                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-600">
                                {{ strtoupper(substr($item->user->nama_lengkap ?? '?', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-800 truncate">{{ $item->user->nama_lengkap ?? 'Pengguna terhapus' }}</p>
                                <p class="text-xs text-slate-500 truncate">
                                    {{ $item->judul_abstrak ?? ('Rp ' . number_format($item->nominal ?? 0, 0, ',', '.')) }}
                                </p>
                            </div>
                            <span class="text-xs text-slate-400 whitespace-nowrap">{{ $item->created_at->diffForHumans() }}</span>
                            <span class="text-xs font-semibold text-emerald-700 whitespace-nowrap">Review <i class="fas fa-chevron-right ml-1"></i></span>
                        </a>
                    @empty
                        <div class="px-5 py-8 text-center text-sm text-slate-400">
                            <i class="fas fa-circle-check text-2xl text-emerald-400 mb-2 block"></i>
                            Tidak ada yang menunggu. Semua sudah diproses.
                        </div>
                    @endforelse
                </div>
            @endforeach
        </div>

        <div class="space-y-4 md:space-y-6">
            {{-- Ringkasan abstrak --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-5">
                <h3 class="font-semibold text-slate-800 mb-4"><i class="fas fa-chart-simple text-emerald-600 mr-2"></i>Ringkasan</h3>
                @php $totalAbs = max($stat['abstrak_total'], 1); @endphp
                @foreach([
                    ['Abstrak diterima', $stat['abstrak_diterima'], 'bg-emerald-500'],
                    ['Abstrak menunggu', $stat['abstrak_pending'], 'bg-amber-400'],
                    ['Abstrak ditolak', $stat['abstrak_ditolak'], 'bg-red-400'],
                ] as [$l, $n, $bar])
                    <div class="mb-3">
                        <div class="flex justify-between text-xs mb-1"><span class="text-slate-600">{{ $l }}</span><span class="font-semibold">{{ $n }}</span></div>
                        <div class="h-2 bg-slate-100 rounded-full overflow-hidden"><div class="h-full {{ $bar }} rounded-full" style="width: {{ round($n / $totalAbs * 100) }}%"></div></div>
                    </div>
                @endforeach
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="text-xs text-slate-500">Pemasukan terverifikasi</p>
                    <p class="text-xl font-bold text-emerald-700">Rp {{ number_format($stat['pemasukan'], 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Aktivitas email --}}
            <div class="bg-white rounded-2xl border border-slate-200">
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                    <h3 class="font-semibold text-slate-800"><i class="fas fa-envelope text-emerald-600 mr-2"></i>Email terbaru</h3>
                    <a href="{{ route('admin.emails.index') }}" class="text-xs font-semibold text-emerald-700 hover:underline">Semua</a>
                </div>
                @include('admin.partials.email-list', ['emailLogs' => $emailTerbaru, 'ringkas' => true])
            </div>
        </div>
    </div>
@endsection
