{{--
    Progress bar upload file (persentase + ukuran + tombol batal).
    Pakai: @include('peserta.partials.upload-progress', ['id' => 'progress-xxx'])
    lalu di JS: kirimDenganProgress(form, { box, tombol, labelUpload, onGagal }).
    Controller harus membalas JSON: { redirect } jika selesai, { message, errors } jika gagal.
--}}
<div id="{{ $id }}" class="hidden mt-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
    <div class="flex items-center justify-between mb-2">
        <p data-role="label" class="text-sm font-semibold text-emerald-900"></p>
        <span data-role="persen" class="text-sm font-bold text-emerald-700">0%</span>
    </div>
    <div style="width: 100%; height: 10px; background: #d1fae5; border-radius: 9999px; overflow: hidden;">
        <div data-role="bar"
             style="width: 0%; height: 100%; background: linear-gradient(90deg, #059669, #0d9488); border-radius: 9999px; transition: width .2s ease;"></div>
    </div>
    <div class="flex items-center justify-between mt-2">
        <p data-role="detail" class="text-xs text-emerald-800"></p>
        <button type="button" data-role="batal" class="text-xs font-semibold text-red-600 hover:text-red-700">
            <i class="fas fa-times mr-1"></i>Batalkan
        </button>
    </div>
</div>

@once
<script>
    window.kirimDenganProgress = function (form, opsi) {
        if (form._xhrUpload) return;

        const box = opsi.box;
        const ambil = function (role) { return box.querySelector('[data-role="' + role + '"]'); };
        const bar = ambil('bar'), persen = ambil('persen'), label = ambil('label'), detail = ambil('detail'), batal = ambil('batal');
        const tombol = opsi.tombol;
        const tombolHtml = tombol.innerHTML;

        const ukuran = function (b) {
            return b < 1024 * 1024 ? Math.round(b / 1024) + ' KB' : (b / 1048576).toFixed(1) + ' MB';
        };
        const atur = function (p, teksLabel, teksDetail) {
            bar.style.width = p + '%';
            persen.textContent = p + '%';
            if (teksLabel) label.innerHTML = teksLabel;
            detail.textContent = teksDetail || '';
        };
        // Cegah tab tertutup tidak sengaja saat upload berjalan.
        const cegahTutup = function (e) { e.preventDefault(); e.returnValue = ''; };

        const selesai = function () {
            form._xhrUpload = null;
            tombol.disabled = false;
            tombol.style.opacity = '';
            tombol.innerHTML = tombolHtml;
            box.classList.add('hidden');
            window.removeEventListener('beforeunload', cegahTutup);
        };
        const gagal = function (pesan) {
            selesai();
            opsi.onGagal(pesan);
        };

        tombol.disabled = true;
        tombol.style.opacity = '0.7';
        tombol.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...';
        box.classList.remove('hidden');
        batal.classList.remove('hidden');
        atur(0, '<i class="fas fa-spinner fa-spin mr-1"></i> ' + (opsi.labelUpload || 'Mengunggah file...'), '');
        window.addEventListener('beforeunload', cegahTutup);

        const xhr = new XMLHttpRequest();
        form._xhrUpload = xhr;
        xhr.open('POST', form.action);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        batal.onclick = function () { xhr.abort(); };

        xhr.upload.addEventListener('progress', function (ev) {
            if (!ev.lengthComputable) return;
            const p = Math.min(99, Math.floor((ev.loaded / ev.total) * 100));
            atur(p, null, ukuran(ev.loaded) + ' dari ' + ukuran(ev.total));
        });

        xhr.upload.addEventListener('load', function () {
            // File sudah terkirim seluruhnya, tinggal server memproses.
            atur(100, '<i class="fas fa-cog fa-spin mr-1"></i> Memproses di server...', 'Mohon tunggu sebentar');
            batal.classList.add('hidden');
        });

        xhr.addEventListener('load', function () {
            let data = {};
            try { data = JSON.parse(xhr.responseText); } catch (err) {}

            if (xhr.status >= 200 && xhr.status < 300 && data.redirect) {
                atur(100, data.ok === false
                    ? '<i class="fas fa-spinner fa-spin mr-1"></i> Mengalihkan...'
                    : '<i class="fas fa-check-circle mr-1"></i> Upload berhasil! Memuat halaman...', '');
                window.removeEventListener('beforeunload', cegahTutup);
                window.location.href = data.redirect;
                return;
            }

            if (xhr.status === 422 && data.errors) {
                gagal(Object.values(data.errors).flat().join(' ') || data.message);
            } else if (xhr.status === 413) {
                gagal('Ukuran file terlalu besar untuk diterima server. Perkecil file (maks. 10MB) lalu coba lagi.');
            } else if (xhr.status === 419) {
                gagal('Sesi Anda sudah berakhir. Muat ulang halaman (F5) lalu upload kembali.');
            } else {
                gagal(data.message || 'Upload gagal (kode ' + xhr.status + '). Silakan coba lagi.');
            }
        });

        xhr.addEventListener('error', function () {
            gagal('Koneksi terputus saat mengunggah. Periksa internet Anda lalu coba lagi.');
        });

        xhr.addEventListener('abort', function () {
            gagal('Upload dibatalkan.');
        });

        xhr.send(new FormData(form));
    };
</script>
@endonce
