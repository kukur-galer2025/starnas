{{-- Daftar ringkas status email. Variabel: $emailLogs, $ringkas (bool, opsional) --}}
@forelse($emailLogs as $log)
    @php [$labelStatus, $warnaStatus, $ikonStatus] = $log->labelStatus(); @endphp
    <div class="flex items-start gap-3 px-5 py-3 border-b border-slate-50 last:border-0">
        <span class="mt-0.5 inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full whitespace-nowrap {{ $warnaStatus }}">
            <i class="fas {{ $ikonStatus }}"></i> {{ $labelStatus }}
        </span>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-slate-800 truncate">{{ $log->subjek }}</p>
            <p class="text-xs text-slate-500 truncate">
                @unless($ringkas ?? false){{ $log->email }} &middot; @endunless{{ $log->created_at->diffForHumans() }}
            </p>
            @if($log->status === 'gagal' && $log->error)
                <p class="text-[11px] text-red-600 mt-0.5 line-clamp-2" title="{{ $log->error }}">{{ $log->error }}</p>
            @endif
        </div>
        @if($log->status !== 'terkirim' && !($ringkas ?? false))
            <form action="{{ route('admin.emails.resend', $log) }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-semibold text-emerald-700 hover:text-emerald-900 whitespace-nowrap" title="Kirim ulang">
                    <i class="fas fa-rotate-right"></i> Kirim ulang
                </button>
            </form>
        @endif
    </div>
@empty
    <div class="px-5 py-6 text-center text-sm text-slate-400">Belum ada email.</div>
@endforelse
