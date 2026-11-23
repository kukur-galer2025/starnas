@extends('auth.layout-kartu')

@section('title', 'Buat Password Baru')

@section('content')
    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4">
        <i class="fas fa-lock"></i>
    </div>
    <h1 class="text-xl font-extrabold text-slate-900 mb-1">Buat Password Baru</h1>
    <p class="text-sm text-slate-600 mb-5">Password minimal 8 karakter.</p>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ $errors->first() }}
            @if($errors->has('email'))
                <a href="{{ route('password.request') }}" class="block mt-1 font-semibold underline">Minta link baru</a>
            @endif
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fas fa-envelope text-emerald-600 mr-1"></i> Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required
                class="w-full rounded-xl border border-slate-300 p-3 text-sm bg-slate-50 focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
            <label for="password" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fas fa-lock text-emerald-600 mr-1"></i> Password baru
            </label>
            <input id="password" type="password" name="password" required minlength="8" autofocus
                class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <div>
            <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1">
                <i class="fas fa-lock text-emerald-600 mr-1"></i> Ulangi password baru
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required minlength="8"
                class="w-full rounded-xl border border-slate-300 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <button type="submit"
            class="w-full flex justify-center items-center py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 shadow-lg shadow-emerald-600/30 transition">
            <i class="fas fa-check mr-2"></i> Simpan Password
        </button>
    </form>
@endsection
