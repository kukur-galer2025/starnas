@extends('admin.layouts.app')

@section('title', 'Manajemen User Terdaftar')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Daftar Semua Akun</h3>

        <div class="mb-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 items-center">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari Nama atau Nomor HP..." 
                    value="{{ request('search') }}"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 sm:text-sm"
                >
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i class="fas fa-search mr-1"></i> Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-sync mr-1"></i> Reset
                    </a>
                @endif
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No.</th> 
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. HP (WA)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Terdaftar Sejak</th>
                        <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->nama_lengkap }}</td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($user->nomor_handphone)
                                    @php
                                        // Pastikan nomor berformat 628... untuk link WA yang benar
                                        $cleanNumber = preg_replace('/[^0-9]/', '', $user->nomor_handphone);
                                        if (substr($cleanNumber, 0, 1) === '0') {
                                            $cleanNumber = '62' . substr($cleanNumber, 1);
                                        }
                                        $waLink = 'https://wa.me/' . $cleanNumber;
                                    @endphp
                                    <a href="{{ $waLink }}" target="_blank" class="text-green-600 hover:text-green-800 flex items-center gap-2">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                        {{ $user->nomor_handphone }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->role == 'admin' ? 'bg-slate-800 text-emerald-400' : 'bg-emerald-100 text-emerald-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            
                            <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-emerald-600 hover:text-emerald-800 flex items-center justify-center gap-1 font-semibold">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection