<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STARNAS ASASI & ICoABCD 2026</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at 10% 20%, #064e3b 0%, #050b14 60%, #022c22 100%);
            min-height: 100vh;
            padding: 16px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(16, 185, 129, 0.25);
        }

        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
        }

        .gradient-bg {
            background: linear-gradient(145deg, #022c22 0%, #064e3b 55%, #047857 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, #34d399, #059669);
            color: #ffffff;
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem !important;
            font-size: 0.7rem !important;
        }

        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.3);
        }

        .text-gradient {
            background: linear-gradient(135deg, #34d399 0%, #22d3ee 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }

        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }

        .login-container {
            height: auto;
            max-height: 95vh;
            overflow-y: auto;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 768px) {
            .login-container {
                max-height: none;
                overflow-y: visible;
            }

            .mobile-stack {
                display: flex;
                flex-direction: column;
            }

            .mobile-padding {
                padding: 20px;
            }

            .mobile-text-center {
                text-align: center;
            }

            .mobile-mb-4 {
                margin-bottom: 1rem;
            }

            .mobile-space-y-4 {
                margin-top: 1rem;
            }
        }

        /* Tambahan untuk konten yang lebih panjang */
        .login-form-container {
            position: relative;
            z-index: 10;
        }

        /* Gaya untuk gambar logo agar pas di dalam div */
        .logo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        /* Kompresi elemen form untuk ruang lebih */
        .form-space-compact {
            margin-bottom: 0.75rem;
        }

        .whatsapp-section {
            padding: 0.75rem !important;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="w-full max-w-4xl bg-white/95 backdrop-blur-sm rounded-2xl card-shadow overflow-hidden login-container
                transform transition-all duration-700 ease-in-out opacity-0 translate-y-4" x-data="{}"
        x-init="$el.classList.remove('opacity-0', 'translate-y-4');">

        <div class="md:flex mobile-stack">

            <div class="md:w-2/5 gradient-bg text-white p-6 flex flex-col justify-between mobile-padding relative overflow-hidden">
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <div
                        class="absolute top-0 left-0 w-32 h-32 md:w-48 md:h-48 bg-emerald-400 rounded-full mix-blend-screen filter blur-2xl opacity-70">
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-32 h-32 md:w-48 md:h-48 bg-teal-400 rounded-full mix-blend-screen filter blur-2xl opacity-70">
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="text-center mb-4 mobile-mb-4">
                        <div
                            class="w-16 h-16 md:w-20 md:h-20 mx-auto mb-3 rounded-2xl bg-white/10 border border-emerald-400/30 flex items-center justify-center logo-container shadow-lg shadow-emerald-950/40">
                            <img src="/storage/starnas.png" alt="Logo STARNAS 2026" class="rounded-lg object-contain">
                        </div>
                        <div class="inline-flex items-center px-3 py-1 glass-effect rounded-full text-xs mb-3 text-emerald-200">
                            <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></span>
                            <i class="fas fa-calendar-alt mr-1"></i>1-2 Desember 2026
                        </div>
                        <h1 class="text-xl md:text-2xl font-black mb-2">
                            <span class="text-gradient">STARNAS ASASI & ICoABCD</span>
                            <span class="text-white">2026</span>
                        </h1>
                    </div>

                    <div class="text-center mb-4 mobile-mb-4 mobile-text-center">
                        <h2 class="text-base md:text-lg font-bold text-emerald-300 mb-2">Seminar Teknologi dan Sains Nasional ASASI & ICoABCD 2026</h2>
                        <p class="text-emerald-100/90 text-xs leading-relaxed">
                            AI untuk Dukung Tenaga Terampil Dalam Mewujudkan Kemandirian Ekonomi dan Energi
                        </p>
                    </div>

                    <div class="space-y-2 mb-4 mobile-mb-4">
                        <div class="flex items-center glass-effect p-2.5 rounded-xl border border-emerald-500/20">
                            <div
                                class="w-6 h-6 md:w-7 md:h-7 bg-amber-500 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0 shadow-sm">
                                <i class="fas fa-certificate text-white text-xs"></i>
                            </div>
                            <span class="text-xs text-slate-100 font-medium">Certificate & Book Chapter ber-ISBN</span>
                        </div>
                        <div class="flex items-center glass-effect p-2.5 rounded-xl border border-emerald-500/20">
                            <div
                                class="w-6 h-6 md:w-7 md:h-7 bg-teal-500 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0 shadow-sm">
                                <i class="fas fa-users text-white text-xs"></i>
                            </div>
                            <span class="text-xs text-slate-100 font-medium">Networking dengan Pakar & Praktisi</span>
                        </div>
                        <div class="flex items-center glass-effect p-2.5 rounded-xl border border-emerald-500/20">
                            <div
                                class="w-6 h-6 md:w-7 md:h-7 bg-emerald-400 text-slate-950 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0 shadow-sm font-bold">
                                <i class="fas fa-trophy text-xs"></i>
                            </div>
                            <span class="text-xs text-slate-100 font-medium">Kesempatan Best Paper & Presenter</span>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 text-center mt-4 md:mt-0">
                    <div class="flex items-center justify-center text-emerald-200 text-xs bg-emerald-950/40 border border-emerald-500/30 rounded-xl p-2.5 backdrop-blur-sm">
                        <i class="fas fa-map-marker-alt mr-2 text-emerald-400"></i>
                        <span>Grand Hotel De Djokja, Yogyakarta</span>
                    </div>
                </div>
            </div>

            <div class="md:w-3/5 p-6 md:p-8 mobile-padding login-form-container">
                <div class="mb-4 mobile-mb-4">
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 mb-2 mobile-text-center">
                        Login <span class="text-gradient">Peserta</span>
                    </h1>
                    <p class="text-slate-600 text-sm mobile-text-center">
                        Masuk ke akun Anda untuk mengakses fitur STARNAS ASASI & ICoABCD 2026.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div class="form-space-compact">
                        <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                            <i class="fas fa-envelope text-emerald-600 mr-1"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-input w-full rounded-xl shadow-sm focus:ring-emerald-500 p-3 text-sm transition duration-150 ease-in-out @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-space-compact">
                        <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">
                            <i class="fas fa-lock text-emerald-600 mr-1"></i>
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input id="password" type="password" name="password" required
                            class="form-input w-full rounded-xl shadow-sm focus:ring-emerald-500 p-3 text-sm transition duration-150 ease-in-out @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 form-space-compact">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-slate-300 rounded">
                            <label for="remember_me" class="ml-2 block text-xs text-slate-700">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <!-- Hubungi Admin WhatsApp -->
                    <div class="bg-emerald-50/70 border border-emerald-200/80 rounded-xl whatsapp-section text-center p-3">
                        <p class="text-xs text-emerald-900 mb-2 font-medium">
                            <i class="fas fa-info-circle mr-1 text-emerald-600"></i>
                            Jika lupa password atau butuh bantuan, hubungi admin
                        </p>
                        <a href="https://wa.me/628122718132" target="_blank"
                            class="inline-flex items-center justify-center py-1.5 px-3 rounded-lg btn-whatsapp font-medium text-xs">
                            <i class="fab fa-whatsapp mr-1 text-sm"></i>
                            Hubungi via WhatsApp
                        </a>
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-6 border border-transparent rounded-xl shadow-lg text-sm md:text-base font-bold text-white 
                                btn-primary transition duration-300 ease-in-out transform hover:scale-[1.02] active:scale-95 shadow-emerald-600/30">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            LOGIN KE AKUN
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-3">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white/95 px-2 text-slate-500 font-semibold">atau masuk dengan</span>
                        </div>
                    </div>

                    <!-- Tombol Login Google -->
                    <div>
                        <a href="{{ route('auth.google') }}"
                            class="w-full flex justify-center items-center py-2.5 px-4 border border-slate-200 rounded-xl shadow-sm bg-white hover:bg-slate-50 text-sm font-semibold text-slate-700 transition duration-300 ease-in-out transform hover:scale-[1.01] active:scale-95 hover:border-emerald-300">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                            Masuk dengan Google
                        </a>
                    </div>

                    <div class="text-center text-xs text-slate-600 pt-1">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                            class="font-semibold text-emerald-600 hover:text-emerald-700 transition duration-150 ease-in-out ml-1">
                            Daftar di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>