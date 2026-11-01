<div id="bell-wrap" class="relative">
    <button id="bell-btn" type="button" aria-label="Notifikasi"
        class="relative w-11 h-11 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center transition-all duration-300 shadow-lg">
        <i class="fas fa-bell text-white"></i>
        <span id="bell-badge" class="hidden absolute -top-1.5 -right-1.5 min-w-[1.25rem] h-5 px-1 rounded-full bg-red-500 text-white text-[11px] font-bold flex items-center justify-center ring-2 ring-emerald-800"></span>
    </button>

    <div id="bell-panel" class="hidden absolute right-0 mt-2 top-full w-80 max-w-[90vw] rounded-2xl shadow-2xl bg-white ring-1 ring-black/5 z-50 overflow-hidden">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
            <p class="font-semibold text-gray-800 text-sm"><i class="fas fa-bell text-primary mr-2"></i>Notifikasi</p>
            <button id="bell-read-all" type="button" class="text-xs font-semibold text-primary hover:underline">Tandai semua dibaca</button>
        </div>

        <div id="bell-list" class="max-h-80 overflow-y-auto">
            <p class="px-4 py-8 text-center text-sm text-gray-400">Memuat...</p>
        </div>

        <div class="px-4 py-3 bg-amber-50 border-t border-amber-100 text-xs text-amber-800 leading-relaxed">
            <i class="fas fa-triangle-exclamation mr-1"></i>
            <strong>Selalu cek folder Spam/Junk</strong> email Anda. Notifikasi dikirim ke email juga, dan kadang masuk spam.
        </div>
    </div>
</div>

<script>
    (function () {
        var urlList = @json(route('peserta.notifikasi.index'));
        var urlReadAll = @json(route('peserta.notifikasi.baca-semua'));
        var csrf = @json(csrf_token());
        var btn = document.getElementById('bell-btn');
        var panel = document.getElementById('bell-panel');
        var badge = document.getElementById('bell-badge');
        var list = document.getElementById('bell-list');
        var lastCount = null;

        function esc(t) { var d = document.createElement('div'); d.textContent = t == null ? '' : t; return d.innerHTML; }

        function render(d) {
            if (d.belum_dibaca > 0) {
                badge.textContent = d.belum_dibaca > 9 ? '9+' : d.belum_dibaca;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            if (!d.items.length) {
                list.innerHTML = '<p class="px-4 py-8 text-center text-sm text-gray-400"><i class="fas fa-bell-slash text-2xl block mb-2"></i>Belum ada notifikasi.</p>';
                return;
            }

            list.innerHTML = d.items.map(function (n) {
                return '<a href="' + esc(n.url) + '" class="flex gap-3 px-4 py-3 border-b border-gray-50 hover:bg-gray-50 ' + (n.baru ? 'bg-emerald-50/60' : '') + '">' +
                    '<span class="mt-1.5 w-2 h-2 rounded-full flex-shrink-0 ' + (n.baru ? 'bg-emerald-500' : 'bg-transparent') + '"></span>' +
                    '<span class="min-w-0"><span class="block text-sm ' + (n.baru ? 'font-semibold' : 'font-medium') + ' text-gray-800">' + esc(n.judul) + '</span>' +
                    (n.pesan ? '<span class="block text-xs text-gray-500 mt-0.5 line-clamp-2">' + esc(n.pesan) + '</span>' : '') +
                    '<span class="block text-[11px] text-gray-400 mt-1">' + esc(n.waktu) + '</span></span></a>';
            }).join('');
        }

        var versi = null;
        var sibuk = false;
        var terakhirAktif = Date.now();
        var kanal = ('BroadcastChannel' in window) ? new BroadcastChannel('starnas-notif') : null;

        // Ambil daftar lengkap (dipakai saat ada perubahan atau panel dibuka).
        function muat() {
            return fetch(urlList, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin', cache: 'no-store' })
                .then(function (r) { return r.ok ? r.json() : null; })
                .then(function (d) {
                    if (!d) return;
                    if (lastCount !== null && d.belum_dibaca > lastCount) goyang();
                    lastCount = d.belum_dibaca;
                    versi = d.versi;
                    render(d);
                })
                .catch(function () {});
        }

        // Cek cepat: respons sangat kecil, daftar diambil hanya jika versi berubah.
        function cek() {
            if (document.hidden || sibuk) return;
            sibuk = true;
            fetch(urlList + '?cek=1', { headers: { 'Accept': 'application/json' }, credentials: 'same-origin', cache: 'no-store' })
                .then(function (r) { return r.ok ? r.json() : null; })
                .then(function (d) {
                    if (d && d.versi !== versi) {
                        if (kanal) kanal.postMessage('berubah');
                        return muat();
                    }
                })
                .catch(function () {})
                .then(function () { sibuk = false; });
        }

        function goyang() {
            btn.animate([{ transform: 'rotate(0)' }, { transform: 'rotate(-18deg)' }, { transform: 'rotate(18deg)' }, { transform: 'rotate(0)' }], { duration: 500, iterations: 2 });
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            panel.classList.toggle('hidden');
            if (!panel.classList.contains('hidden')) muat();
        });
        document.addEventListener('click', function (e) {
            if (!document.getElementById('bell-wrap').contains(e.target)) panel.classList.add('hidden');
        });
        document.getElementById('bell-read-all').addEventListener('click', function () {
            fetch(urlReadAll, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, credentials: 'same-origin' })
                .then(function () { lastCount = 0; if (kanal) kanal.postMessage('berubah'); muat(); });
        });

        // Tab lain di browser yang sama ikut diperbarui seketika.
        if (kanal) kanal.onmessage = function () { muat(); };

        // Interval adaptif: 3 detik saat aktif, 15 detik bila tidak ada aktivitas > 2 menit,
        // berhenti saat tab disembunyikan, dan langsung cek ketika tab kembali dibuka.
        ['mousemove', 'keydown', 'scroll', 'touchstart'].forEach(function (ev) {
            window.addEventListener(ev, function () { terakhirAktif = Date.now(); }, { passive: true });
        });
        (function jadwal() {
            var idle = Date.now() - terakhirAktif > 120000;
            setTimeout(function () { cek(); jadwal(); }, idle ? 15000 : 3000);
        })();
        document.addEventListener('visibilitychange', function () { if (!document.hidden) cek(); });
        window.addEventListener('focus', cek);

        muat();
    })();
</script>
