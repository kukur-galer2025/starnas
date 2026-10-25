@extends('admin.layouts.app')

@section('title', 'Laporan Pembayaran Peserta')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-2xl">
        
        {{-- HEADER & EXPORT BUTTON --}}
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
            <h3 class="text-3xl font-extrabold text-gray-900 flex items-center">
                <i class="fas fa-file-invoice-dollar mr-3 text-emerald-600"></i> Data Laporan Pembayaran
            </h3>
            
            <a href="{{ route('admin.reports.payments.export-pdf', ['search' => request('search')]) }}" target="_blank"
               class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-red-600 hover:bg-red-700 transition duration-150 transform hover:scale-105">
                <i class="fas fa-file-pdf mr-2"></i> Ekspor ke PDF ({{ $payments->count() }} Data)
            </a>
        </div>

        {{-- SEARCH FORM --}}
        <div class="mb-6">
            <form action="{{ route('admin.reports.payments.index') }}" method="GET" class="flex gap-3 items-center">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari Nama, Email, atau No. HP Peserta..." 
                    value="{{ request('search') }}"
                    class="block w-full rounded-xl border-gray-300 shadow-sm p-3 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm transition duration-150"
                >
                <button type="submit" class="inline-flex items-center px-5 py-3 border border-transparent rounded-xl shadow-md text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.reports.payments.index') }}" class="inline-flex items-center px-5 py-3 border border-gray-300 rounded-xl shadow-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-sync mr-1"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        @if ($payments->isEmpty())
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl flex items-center gap-3 shadow-inner">
                <i class="fas fa-info-circle text-xl text-emerald-600"></i>
                <p class="font-medium">
                    @if (request('search'))
                        Tidak ditemukan data pembayaran untuk pencarian "{{ request('search') }}".
                    @else
                        Belum ada data pembayaran yang tercatat dalam sistem.
                    @endif
                </p>
            </div>
        @else
            <div class="text-md font-medium text-gray-700 mb-3">
                Menampilkan {{ $payments->count() }} data pembayaran.
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-md">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="pl-6 pr-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tl-xl">No.</th> 
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Peserta</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email / No. HP</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="pr-6 pl-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider rounded-tr-xl">Tgl Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($payments as $index => $payment)
                            <tr class="hover:bg-emerald-50/40 transition duration-100">
                                <td class="pl-6 pr-4 py-4 whitespace-nowrap text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $payment->user->nama_lengkap }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                    {{ $payment->user->email }}<br>
                                    @if($payment->user->nomor_handphone)
                                        <span class="text-xs text-emerald-600 font-medium">{{ $payment->user->nomor_handphone }}</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 font-medium">
                                    @switch($payment->kategori_pembayaran)
                                        @case('asasi') <span class="text-emerald-700 font-semibold">Anggota ASASI</span> @break
                                        @case('umum') Umum @break
                                        @case('mahasiswa') Mahasiswa @break
                                        @case('non-presenter') Non Presenter @break
                                        @default {{ ucfirst($payment->kategori_pembayaran) }}
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-right text-emerald-700">
                                    Rp {{ number_format($payment->nominal, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'verified' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                        ][$payment->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td class="pr-6 pl-4 py-4 whitespace-nowrap text-center text-gray-600">
                                    {{ $payment->status == 'verified' ? $payment->updated_at->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                        @endforeach
                        
                        {{-- ROW TOTAL NOMINAL --}}
                        <tr class="font-bold bg-emerald-50/60">
                            <td colspan="4" class="px-6 py-4 text-left border-t border-gray-900">
                                <span class="text-xl text-gray-900">Total Nominal:</span>
                            </td>
                            <td colspan="3" class="px-6 py-4 text-right font-extrabold text-2xl text-emerald-800 border-t border-gray-900">
                                Rp {{ number_format($payments->sum('nominal'), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection