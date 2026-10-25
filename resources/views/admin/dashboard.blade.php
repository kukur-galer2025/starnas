@extends('admin.layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Card Total Users --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-emerald-500">
            <h4 class="text-sm font-medium text-gray-500">Total Pengguna Sistem</h4>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUsers }}</p>
        </div>

        {{-- Card Total Peserta --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-green-500">
            <h4 class="text-sm font-medium text-gray-500">Total Peserta Terdaftar</h4>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalPeserta }}</p>
        </div>

        {{-- Card Pembayaran Pending --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-yellow-500">
            <h4 class="text-sm font-medium text-gray-500">Verifikasi Pembayaran Tertunda</h4>
            <p class="text-3xl font-bold text-red-600 mt-1">{{ $pendingPayments }}</p>
        </div>
        
    </div>

    <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Penting</h3>
        <p class="text-gray-600">
            Selamat datang di Panel Administrasi STARNAS. Gunakan menu di sidebar untuk mengelola akun pengguna dan memverifikasi bukti pembayaran.
        </p>
    </div>
@endsection