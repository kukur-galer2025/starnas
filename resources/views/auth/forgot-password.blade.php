@extends('auth.layout-kartu')

@section('title', 'Lupa Password')

@section('content')
    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4">
        <i class="fas fa-key"></i>
    </div>
    <h1 class="text-xl font-extrabold text-slate-900 mb-1">Lupa Password?</h1>
    <p class="text-sm text-slate-600 mb-5">
        Masukkan email akun Anda. Kami akan mengirim link untuk membuat password baru.
    </p>

    @if(session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm mb-4" role="status">
            <i class="fas fa-circle-check mr-1"></i> {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fas fa-envelope text-emerald-600 mr-1"></i> Email terdaftar
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
        </div>
        <button type="submit"
            class="w-full flex justify-center items-center py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-600/30 transition">
            <i class="fas fa-paper-plane mr-2"></i> Kirim Link Reset
        </button>
    </form>

    <p class="text-xs text-slate-500 mt-4">
        <i class="fab fa-google mr-1"></i> Biasa masuk dengan Google? Anda tetap bisa memakai tombol
        <strong>Masuk dengan Google</strong> tanpa password.
    </p>

    <div class="text-center mt-5">
        <a href="{{ route('login') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
        </a>
    </div>
@endsection
