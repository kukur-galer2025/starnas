<script>
    // Pantau perubahan status abstrak / pembayaran dari admin dan perbarui halaman otomatis.
    (function () {
        var url = @json($syncUrl);
        var INTERVAL = 8000;
        var last = null;
        var dirty = false;
        var notified = false;

        document.addEventListener('input', function (e) {
            if (e.target.closest && e.target.closest('form')) dirty = true;
        });
        document.addEventListener('change', function (e) {
            if (e.target.closest && e.target.closest('form')) dirty = true;
        });

        function toast(reloadNow) {
            if (notified) return;
            notified = true;
            var el = document.createElement('div');
            el.setAttribute('role', 'status');
            el.style.cssText = 'position:fixed;right:16px;bottom:16px;z-index:9999;max-width:340px;background:#065f46;color:#fff;padding:14px 16px;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,.25);font-size:14px;line-height:1.4;';
            el.innerHTML = '<strong><i class="fas fa-bell" style="margin-right:6px"></i>{{ $syncPesan ?? 'Data diperbarui' }}</strong>' +
                (reloadNow ? '<div style="margin-top:4px;opacity:.9">Memuat ulang halaman...</div>'
                           : '<div style="margin-top:4px;opacity:.9">Anda sedang mengisi form. <a href="#" id="sync-reload" style="color:#fde68a;text-decoration:underline;font-weight:600">Muat ulang sekarang</a></div>');
            document.body.appendChild(el);
            var link = document.getElementById('sync-reload');
            if (link) link.addEventListener('click', function (e) { e.preventDefault(); location.reload(); });
        }

        function check() {
            if (document.hidden) return;
            fetch(url, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin', cache: 'no-store' })
                .then(function (r) { return r.ok ? r.json() : null; })
                .then(function (d) {
                    if (!d) return;
                    var sig = d.abstrak + '#' + d.pembayaran + '#' + (d.user || '');
                    if (last === null) { last = sig; return; }
                    if (sig !== last) {
                        if (dirty) { toast(false); }
                        else { toast(true); setTimeout(function () { location.reload(); }, 1200); }
                    }
                })
                .catch(function () { /* abaikan gangguan jaringan sesaat */ });
        }

        check();
        setInterval(check, INTERVAL);
        document.addEventListener('visibilitychange', function () { if (!document.hidden) check(); });
    })();
</script>
