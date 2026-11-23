@extends('peserta.layouts.main')

@section('title', 'Pengumuman Panitia')

@section('content')
    <div class="flex items-center mb-6">
        <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
            <i class="fas fa-bullhorn text-primary text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pengumuman Panitia</h1>
            <p class="text-gray-500 text-sm mt-1">Informasi penting seperti jadwal sesi dan link acara online.</p>
        </div>
    </div>

    @if($pengumumans->isEmpty())
        <div class="bg-teal-50 border border-teal-200 rounded-2xl p-8 text-center">
            <i class="fas fa-inbox text-teal-400 text-4xl mb-3"></i>
            <p class="text-teal-800 font-medium">Belum ada pengumuman untuk Anda.</p>
            <p class="text-teal-600 text-sm mt-1">Pengumuman baru juga akan muncul di ikon lonceng dan dikirim ke email Anda.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($pengumumans as $p)
                <article class="bg-white rounded-2xl shadow border border-gray-200 border-l-4 border-l-emerald-500 p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-2">
                        <h2 class="font-bold text-gray-900 text-lg">{{ $p->judul }}</h2>
                        <span class="text-xs text-gray-400">
                            <i class="far fa-clock mr-1"></i>{{ $p->created_at->locale('id')->translatedFormat('j F Y, H.i') }} WIB
                        </span>
                    </div>
                    <div class="text-sm text-gray-700 leading-relaxed">{{ $p->isiHtml() }}</div>
                    @if($p->tautan)
                        <a href="{{ $p->tautan }}" target="_blank" rel="noopener"
                           class="inline-flex items-center mt-4 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl">
                            <i class="fas fa-arrow-up-right-from-square mr-2"></i> {{ $p->teks_tautan ?: 'Buka Tautan' }}
                        </a>
                    @endif
                </article>
            @endforeach
        </div>

        <div class="mt-6">{{ $pengumumans->links() }}</div>
    @endif
@endsection
