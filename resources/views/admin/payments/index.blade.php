@extends('admin.layouts.app')

@section('title', 'Manajemen Bukti Pembayaran')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4">
            <i class="fas fa-check-double mr-2 text-emerald-600"></i> Daftar Semua Submission Pembayaran
        </h3>
        
        <div class="mb-4">
            <form action="{{ route('admin.payments.index') }}" method="GET" class="flex gap-2 items-center">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari berdasarkan Nama Peserta..." 
                    value="{{ request('search') }}"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 sm:text-sm"
                >
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-sync mr-1"></i> Reset
                    </a>
                @endif
            </form>
        </div>
        @if ($payments->isEmpty())
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-lg flex items-center gap-2">
                <i class="fas fa-info-circle text-lg text-emerald-600"></i>
                <div>
                    <p class="font-bold">Informasi!</p>
                    <p>
                        @if (request('search'))
                            Tidak ditemukan bukti pembayaran untuk pencarian **"{{ request('search') }}"**.
                        @else
                            Belum ada satupun bukti pembayaran yang diunggah oleh peserta.
                        @endif
                    </p>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">No.</th> 
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Upload</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Nominal</th>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    {{ $payments->firstItem() + $loop->index }}
                                </td>
                                
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <i class="fas fa-user-circle mr-1 text-gray-400"></i> {{ $payment->user->nama_lengkap }}
                                </td>
                                
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                    @switch($payment->kategori_pembayaran)
                                        @case('asasi') <span class="text-emerald-700 font-semibold">Anggota ASASI</span> @break
                                        @case('umum') Umum @break
                                        @case('mahasiswa') Mahasiswa @break
                                        @case('non-presenter') Non Presenter @break
                                        @default {{ ucfirst($payment->kategori_pembayaran) }}
                                    @endswitch
                                </td>
                                
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-right">
                                    Rp {{ number_format($payment->nominal, 0, ',', '.') }}
                                </td>
                                
                                <td class="px-3 py-4 whitespace-nowrap text-center">
                                    @php
                                        $status = $payment->status;
                                        $statusClass = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                            'verified' => 'bg-green-100 text-green-800 border-green-300',
                                            'rejected' => 'bg-red-100 text-red-800 border-red-300',
                                        ][$status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                                        
                                        $statusIcon = [
                                            'pending' => 'fas fa-hourglass-half',
                                            'verified' => 'fas fa-check-circle',
                                            'rejected' => 'fas fa-times-circle',
                                        ][$status] ?? 'fas fa-question-circle';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        <i class="{{ $statusIcon }} mr-1"></i> {{ ucfirst($status) }}
                                    </span>
                                </td>
                                
                                <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <a href="{{ route('admin.payments.show', $payment->id) }}" class="text-emerald-600 hover:text-emerald-800 inline-flex items-center font-semibold">
                                        <i class="fas fa-eye mr-1"></i> {{ $payment->status == 'verified' ? 'Lihat Detail' : 'Proses' }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
@endsection