<script>
    // Tambahkan tombol "lihat / sembunyikan password" pada semua input password.
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[type="password"]').forEach(function (input) {
            if (input.dataset.toggleReady) return;
            input.dataset.toggleReady = '1';

            var wrap = document.createElement('div');
            wrap.style.position = 'relative';
            input.parentNode.insertBefore(wrap, input);
            wrap.appendChild(input);
            input.style.paddingRight = '2.75rem';

            var btn = document.createElement('button');
            btn.type = 'button';
            btn.setAttribute('aria-label', 'Tampilkan password');
            btn.style.cssText = 'position:absolute;top:0;bottom:0;right:0;width:2.75rem;display:flex;align-items:center;justify-content:center;color:#6b7280;background:transparent;border:0;cursor:pointer;';
            btn.innerHTML = '<i class="fas fa-eye"></i>';
            wrap.appendChild(btn);

            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.innerHTML = show ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
                btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            });
        });
    });
</script>
