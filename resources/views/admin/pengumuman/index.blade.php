@extends('admin.layouts.app')

@section('title', 'Pengumuman ke Peserta')

@section('content')
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">

        {{-- FORM BUAT PENGUMUMAN --}}
        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 p-5 md:p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-1 flex items-center gap-2">
                    <i class="fas fa-bullhorn text-emerald-600"></i> Kirim Pengumuman
                </h2>
                <p class="text-sm text-slate-500 mb-5">
                    Muncul di dashboard & lonceng peserta, dan (opsional) dikirim ke email mereka.
                    Cocok untuk link Zoom peserta online atau jadwal sesi presenter.
                </p>

                @if($errors->any())
                    <div class="mb-4 px-4 py-3 rounded-xl border bg-red-50 border-red-200 text-red-700 text-sm">
                        <i class="fas fa-circle-exclamation mr-1"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-4"
                      onsubmit="return confirm('Kirim pengumuman ini ke ' + this.target.options[this.target.selectedIndex].dataset.jumlah + ' peserta?')">
                    @csrf

                    <div>
                        <label for="target" class="block text-sm font-semibold text-slate-700 mb-1">Kirim ke</label>
                        <select id="target" name="target" required
                                class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            @foreach(\App\Models\Pengumuman::TARGET as $key => $label)
                                <option value="{{ $key }}" data-jumlah="{{ $jumlahTarget[$key] }}" @selected(old('target', 'semua') === $key)>
                                    {{ $label }} ({{ $jumlahTarget[$key] }} orang)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="judul" class="block text-sm font-semibold text-slate-700 mb-1">Judul</label>
                        <input id="judul" name="judul" type="text" maxlength="150" required value="{{ old('judul') }}"
                               placeholder="mis. Link Zoom Sesi Online 1 Desember"
                               class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label for="isi" class="block text-sm font-semibold text-slate-700 mb-1">Isi pengumuman</label>
                        <textarea id="isi" name="isi" rows="7" maxlength="5000" required
                                  placeholder="Tulis pengumuman. Baris baru akan dipertahankan, alamat https://... otomatis bisa diklik."
                                  class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('isi') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-3">
                        <div class="sm:col-span-3">
                            <label for="tautan" class="block text-sm font-semibold text-slate-700 mb-1">Tautan tombol <span class="font-normal text-slate-400">(opsional)</span></label>
                            <input id="tautan" name="tautan" type="url" maxlength="500" value="{{ old('tautan') }}"
                                   placeholder="https://zoom.us/j/..."
                                   class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="teks_tautan" class="block text-sm font-semibold text-slate-700 mb-1">Teks tombol</label>
                            <input id="teks_tautan" name="teks_tautan" type="text" maxlength="60" value="{{ old('teks_tautan') }}"
                                   placeholder="Gabung Zoom"
                                   class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        </div>
                    </div>

                    <label class="flex items-start gap-2 text-sm text-slate-700">
                        <input type="checkbox" name="kirim_email" value="1" class="mt-0.5 h-4 w-4 rounded border-slate-300 text-emerald-600"
                               @checked(old('kirim_email', true))>
                        <span>Kirim juga lewat email
                            <span class="block text-xs text-slate-500">Email dikirim bertahap (10 per putaran) agar tidak melebihi batas kirim. Biarkan panel admin terbuka sampai selesai; pantau di Status Email.</span>
                        </span>
                    </label>

                    <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Pengumuman
                    </button>
                </form>
            </div>
        </div>

        {{-- RIWAYAT PENGUMUMAN --}}
        <div class="xl:col-span-3">
            <div class="bg-white rounded-2xl border border-slate-200">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">Riwayat Pengumuman</h2>
                </div>

                @forelse($pengumumans as $p)
                    <div class="px-5 py-4 border-b border-slate-100 last:border-0">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-900">{{ $p->judul }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    <i class="fas fa-users mr-1"></i>{{ $p->labelTarget() }} &middot; {{ $p->jumlah_penerima }} penerima
                                    &middot; {{ $p->kirim_email ? 'dashboard + email' : 'dashboard saja' }}
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ $p->created_at->locale('id')->translatedFormat('j M Y, H.i') }} WIB
                                    @if($p->admin) oleh {{ $p->admin->nama_lengkap }} @endif
                                </p>
                            </div>
                            <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Hapus pengumuman ini dari dashboard peserta? Email yang sudah terkirim tidak bisa ditarik.')">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-semibold text-red-600 hover:text-red-700 whitespace-nowrap">
                                    <i class="fas fa-trash-alt mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                        <div class="mt-2 text-sm text-slate-700 leading-relaxed bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $p->isiHtml() }}</div>
                        @if($p->tautan)
                            <p class="mt-2 text-xs text-slate-500 break-all">
                                <i class="fas fa-link mr-1"></i>{{ $p->teks_tautan }}: <a href="{{ $p->tautan }}" target="_blank" rel="noopener" class="text-emerald-700 underline">{{ $p->tautan }}</a>
                            </p>
                        @endif
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-slate-500 text-sm">
                        <i class="fas fa-inbox text-3xl text-slate-300 mb-2 block"></i>
                        Belum ada pengumuman.
                    </div>
                @endforelse

                @if($pengumumans->hasPages())
                    <div class="px-5 py-4">{{ $pengumumans->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection
