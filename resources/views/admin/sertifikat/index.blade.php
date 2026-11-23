@extends('admin.layouts.app')

@section('title', 'Sertifikat Khusus')

@section('content')
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- FORM BUAT SERTIFIKAT --}}
        <div>
            <div class="bg-white rounded-2xl border border-slate-200 p-5 md:p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-1 flex items-center gap-2">
                    <i class="fas fa-award text-emerald-600"></i> Buat Sertifikat
                </h2>
                <p class="text-sm text-slate-500 mb-5">
                    Untuk Panitia, Pembicara, Moderator, Reviewer, dan Web Developer. Tidak perlu akun atau pembayaran.
                    Sertifikat peserta tetap dibuat otomatis dari dashboard peserta.
                </p>

                @if($errors->any())
                    <div class="mb-4 px-4 py-3 rounded-xl border bg-red-50 border-red-200 text-red-700 text-sm">
                        <i class="fas fa-circle-exclamation mr-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.sertifikat.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="peran" class="block text-sm font-semibold text-slate-700 mb-1">Peran</label>
                        <select id="peran" name="peran" required
                                class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            @foreach(\App\Models\SertifikatKhusus::PERAN as $p)
                                <option value="{{ $p }}" @selected(old('peran', $peran ?: 'Panitia') === $p)>{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="daftar" class="block text-sm font-semibold text-slate-700 mb-1">Nama (satu orang per baris)</label>
                        <textarea id="daftar" name="daftar" rows="8" required
                                  placeholder="Dr. Budi Santoso, M.T.&#10;Siti Aminah, S.Kom. | Universitas Gadjah Mada&#10;Andi Wijaya"
                                  class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('daftar') }}</textarea>
                        <p class="text-xs text-slate-500 mt-1">
                            Tulis nama lengkap beserta gelar persis seperti yang akan dicetak.
                            Institusi per orang bisa ditambahkan setelah tanda <code class="bg-slate-100 px-1 rounded">|</code>.
                        </p>
                    </div>

                    <div>
                        <label for="institusi" class="block text-sm font-semibold text-slate-700 mb-1">
                            Institusi <span class="font-normal text-slate-400">(opsional, untuk semua nama di atas)</span>
                        </label>
                        <input id="institusi" name="institusi" type="text" maxlength="255" value="{{ old('institusi') }}"
                               placeholder="mis. ASASI"
                               class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold">
                        <i class="fas fa-plus mr-2"></i> Buat Sertifikat
                    </button>
                </form>
            </div>
        </div>

        {{-- DAFTAR SERTIFIKAT --}}
        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200">
                <div class="flex flex-col lg:flex-row lg:items-center gap-3 justify-between p-4 md:p-5 border-b border-slate-100">
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.sertifikat.index', array_filter(['search' => $search])) }}"
                           class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm border transition {{ !$peran ? 'bg-emerald-600 border-emerald-600 text-white' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }}">
                            Semua <span class="text-xs font-bold {{ !$peran ? 'text-white/80' : 'text-slate-400' }}">{{ $jumlahPeran->sum() }}</span>
                        </a>
                        @foreach(\App\Models\SertifikatKhusus::PERAN as $p)
                            <a href="{{ route('admin.sertifikat.index', array_filter(['peran' => $p, 'search' => $search])) }}"
                               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm border transition {{ $peran === $p ? 'bg-emerald-600 border-emerald-600 text-white' : 'bg-white border-slate-200 text-slate-600 hover:border-emerald-300' }}">
                                {{ $p }} <span class="text-xs font-bold {{ $peran === $p ? 'text-white/80' : 'text-slate-400' }}">{{ $jumlahPeran[$p] ?? 0 }}</span>
                            </a>
                        @endforeach
                    </div>
                    <form method="GET" class="flex">
                        @if($peran)<input type="hidden" name="peran" value="{{ $peran }}">@endif
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama / institusi"
                               class="w-full sm:w-52 h-10 px-3 text-sm rounded-l-xl border border-slate-200 focus:outline-none focus:border-emerald-400">
                        <button class="h-10 px-3 rounded-r-xl bg-slate-800 text-white text-sm" aria-label="Cari"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                @forelse($sertifikats as $s)
                    <div class="px-4 md:px-5 py-3 border-b border-slate-100 last:border-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 justify-between">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-900 truncate">{{ $s->nama }}</p>
                                <p class="text-xs text-slate-500">
                                    <span class="inline-block px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-semibold mr-1">{{ $s->peran }}</span>
                                    {{ $s->nomor() }}
                                    @if($s->institusi) &middot; {{ $s->institusi }} @endif
                                </p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="{{ route('admin.sertifikat.show', $s) }}" target="_blank"
                                   class="inline-flex items-center px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold">
                                    <i class="fas fa-download mr-1.5"></i> Lihat &amp; Unduh
                                </a>
                                <button type="button" onclick="document.getElementById('ubah-{{ $s->id }}').classList.toggle('hidden')"
                                        class="inline-flex items-center px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold">
                                    <i class="fas fa-pen mr-1.5"></i> Ubah
                                </button>
                                <form action="{{ route('admin.sertifikat.destroy', $s) }}" method="POST"
                                      onsubmit="return confirm('Hapus sertifikat {{ $s->nomor() }} ({{ addslashes($s->nama) }})? QR pada sertifikat yang sudah dicetak akan tidak berlaku.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline-flex items-center px-3 py-2 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Form ubah (tersembunyi) --}}
                        <form id="ubah-{{ $s->id }}" action="{{ route('admin.sertifikat.update', $s) }}" method="POST"
                              class="hidden mt-3 grid grid-cols-1 sm:grid-cols-7 gap-2">
                            @csrf
                            @method('PUT')
                            <input name="nama" value="{{ $s->nama }}" required maxlength="255"
                                   class="sm:col-span-3 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <select name="peran" class="sm:col-span-1 rounded-lg border border-slate-300 px-2 py-2 text-sm">
                                @foreach(\App\Models\SertifikatKhusus::PERAN as $p)
                                    <option value="{{ $p }}" @selected($s->peran === $p)>{{ $p }}</option>
                                @endforeach
                            </select>
                            <input name="institusi" value="{{ $s->institusi }}" maxlength="255" placeholder="Institusi"
                                   class="sm:col-span-2 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <button class="sm:col-span-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-3 py-2">Simpan</button>
                        </form>
                    </div>
                @empty
                    <div class="px-5 py-12 text-center text-slate-500 text-sm">
                        <i class="fas fa-award text-3xl text-slate-300 mb-2 block"></i>
                        Belum ada sertifikat{{ $peran ? ' ' . $peran : '' }}. Buat lewat form di sebelah kiri.
                    </div>
                @endforelse

                @if($sertifikats->hasPages())
                    <div class="px-5 py-4">{{ $sertifikats->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
