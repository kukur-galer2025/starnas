@extends('admin.layouts.app')

@section('title', 'Status Pengiriman Email')

@section('content')
    @php
        $tab = [
            ['', 'Semua', $ringkas['semua'], 'fa-inbox'],
            ['terkirim', 'Terkirim', $ringkas['terkirim'], 'fa-circle-check'],
            ['antri', 'Sedang dikirim', $ringkas['antri'], 'fa-spinner'],
            ['gagal', 'Gagal', $ringkas['gagal'], 'fa-circle-xmark'],
        ];
    @endphp

    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="flex flex-col lg:flex-row lg:items-center gap-3 justify-between p-4 md:p-5 border-b border-slate-100">
            <div class="flex flex-wrap gap-2">
                @foreach($tab as [$val, $label, $jml, $ikon])
                    <a href="{{ route('admin.emails.index', array_filter(['status' => $val, 'search' => $search])) }}"
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm border transition
                        {{ ($status ?? '') === $val ? 'bg-emerald-600 border-emerald-600 text-white' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }}">
                        <i class="fas {{ $ikon }} text-xs"></i> {{ $label }}
                        <span class="text-xs font-bold {{ ($status ?? '') === $val ? 'text-white/80' : 'text-slate-400' }}">{{ $jml }}</span>
                    </a>
                @endforeach
            </div>

            <div class="flex flex-col sm:flex-row gap-2">
                <form method="GET" class="flex">
                    @if($status)<input type="hidden" name="status" value="{{ $status }}">@endif
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari email / subjek"
                        class="w-full sm:w-56 h-10 px-3 text-sm rounded-l-xl border border-slate-200 focus:outline-none focus:border-emerald-400">
                    <button class="h-10 px-3 rounded-r-xl bg-slate-800 text-white text-sm" aria-label="Cari"><i class="fas fa-search"></i></button>
                </form>
                @if($ringkas['gagal'] > 0)
                    <form action="{{ route('admin.emails.resend-failed') }}" method="POST">
                        @csrf
                        <button class="h-10 px-4 rounded-xl bg-red-600 hover:bg-red-700 text-white text-sm font-semibold whitespace-nowrap">
                            <i class="fas fa-rotate-right mr-1"></i> Kirim ulang semua yang gagal
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-left text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Penerima</th>
                        <th class="px-5 py-3">Subjek</th>
                        <th class="px-5 py-3">Waktu</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                        @php [$labelStatus, $warnaStatus, $ikonStatus] = $log->labelStatus(); @endphp
                        <tr class="hover:bg-slate-50 align-top">
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full whitespace-nowrap {{ $warnaStatus }}">
                                    <i class="fas {{ $ikonStatus }}"></i> {{ $labelStatus }}
                                </span>
                                @if($log->percobaan > 1)
                                    <p class="text-[11px] text-slate-400 mt-1">{{ $log->percobaan }}x percobaan</p>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-slate-800">{{ $log->user->nama_lengkap ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ $log->email }}</p>
                            </td>
                            <td class="px-5 py-3 max-w-xs">
                                <p class="text-slate-700">{{ $log->subjek }}</p>
                                @if($log->status === 'gagal' && $log->error)
                                    <p class="text-xs text-red-600 mt-1 line-clamp-2" title="{{ $log->error }}"><i class="fas fa-circle-exclamation mr-1"></i>{{ $log->error }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3 whitespace-nowrap text-slate-500">
                                <p>{{ $log->created_at->format('d M Y H:i') }}</p>
                                @if($log->terkirim_at)
                                    <p class="text-[11px] text-emerald-600">terkirim {{ $log->terkirim_at->format('H:i:s') }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right">
                                @if($log->status !== 'terkirim')
                                    <form action="{{ route('admin.emails.resend', $log) }}" method="POST">
                                        @csrf
                                        <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 hover:bg-emerald-100">
                                            <i class="fas fa-rotate-right"></i> Kirim ulang
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-slate-400">
                            <i class="fas fa-envelope-open text-3xl mb-2 block"></i>Belum ada email pada filter ini.
                        </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $logs->links() }}</div>
        @endif
    </div>

    <p class="text-xs text-slate-500 mt-4">
        <i class="fas fa-circle-info mr-1"></i>
        Status diperbarui otomatis. Email dicoba hingga {{ \App\Models\EmailLog::MAKS_PERCOBAAN }} kali; jika tetap gagal, periksa pengaturan SMTP lalu klik "Kirim ulang".
    </p>
@endsection
