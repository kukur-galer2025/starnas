@extends('admin.layouts.app')

@section('title', 'Verifikasi Abstrak')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Verifikasi Abstrak</h2>
            <div class="text-sm text-gray-600">
                Total: <span class="font-semibold">{{ $abstracts->total() }}</span> abstrak
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="md:col-span-2">
                <form action="{{ route('admin.abstracts.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari berdasarkan nama, email, atau judul abstrak..."
                        class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                    <button type="submit"
                        class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-emerald-700 transition-colors">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                </form>
            </div>
            <div>
                <form action="{{ route('admin.abstracts.index') }}" method="GET" class="flex gap-2">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <select name="status" onchange="this.form.submit()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Menunggu ({{ $pendingCount }})
                        </option>
                        <option value="diterima" {{ $status == 'diterima' ? 'selected' : '' }}>Diterima ({{ $acceptedCount }})
                        </option>
                        <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak ({{ $rejectedCount }})
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-clock text-yellow-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-yellow-700">Menunggu Review</p>
                        <p class="text-xl font-bold text-yellow-800">{{ $pendingCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-green-700">Telah Diterima</p>
                        <p class="text-xl font-bold text-green-800">{{ $acceptedCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-times-circle text-red-500 text-2xl mr-3"></i>
                    <div>
                        <p class="text-sm text-red-700">Telah Ditolak</p>
                        <p class="text-xl font-bold text-red-800">{{ $rejectedCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peserta
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            Abstrak</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Upload</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($abstracts as $abstract)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{-- PERBAIKAN: Menggunakan relasi user --}}
                                <div>
                                    <div class="font-medium text-gray-900">{{ $abstract->user->nama_lengkap }}</div>
                                    <div class="text-sm text-gray-500">{{ $abstract->user->email }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                {{-- Judul Abstrak (sudah benar) --}}
                                <div class="text-sm text-gray-900 font-medium">{{ Str::limit($abstract->judul_abstrak, 60) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                     @if($abstract->status_abstrak == 'diterima') bg-green-100 text-green-800
                                     @elseif($abstract->status_abstrak == 'ditolak') bg-red-100 text-red-800
                                     @else bg-yellow-100 text-yellow-800 @endif">
                                    @if($abstract->status_abstrak == 'diterima') Diterima
                                    @elseif($abstract->status_abstrak == 'ditolak') Ditolak
                                    @else Menunggu
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $abstract->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.abstracts.show', $abstract->id) }}"
                                    class="text-primary hover:text-emerald-700 mr-3">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                                <a href="{{ route('admin.abstracts.download', $abstract->id) }}"
                                    class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                <i class="fas fa-file-alt text-4xl mb-2 text-gray-300"></i>
                                <p>Tidak ada abstrak yang perlu diverifikasi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $abstracts->links() }}
        </div>
    </div>
@endsection