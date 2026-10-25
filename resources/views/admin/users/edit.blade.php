@extends('admin.layouts.app')

@section('title', 'Edit User: ' . $user->nama_lengkap)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-8 rounded-2xl shadow-xl">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">
                <i class="fas fa-user-edit mr-2 text-emerald-600"></i> Edit Detail Akun: {{ $user->nama_lengkap }}
            </h3>

            {{-- Form menggunakan method PUT/PATCH sesuai standar RESTful Laravel --}}
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <h4 class="text-lg font-semibold text-gray-700 pt-4 pb-2 border-t mt-4">Data Dasar</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Field: Nama Lengkap --}}
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-id-card mr-1 text-gray-500"></i> Nama Lengkap
                        </label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" 
                               value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Field: Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-at mr-1 text-gray-500"></i> Email
                        </label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $user->email) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Field: Nomor Handphone (BARU) --}}
                    <div>
                        <label for="nomor_handphone" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1 text-gray-500"></i> Nomor Handphone
                        </label>
                        <input type="text" name="nomor_handphone" id="nomor_handphone" 
                               value="{{ old('nomor_handphone', $user->nomor_handphone) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('nomor_handphone') border-red-500 @enderror">
                        @error('nomor_handphone')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Field: Jenis Kelamin (BARU) --}}
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-venus-mars mr-1 text-gray-500"></i> Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" id="jenis_kelamin" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <h4 class="text-lg font-semibold text-gray-700 pt-4 pb-2 border-t mt-4">Data Tambahan</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Field: Institusi (BARU) --}}
                    <div>
                        <label for="institusi" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-school mr-1 text-gray-500"></i> Institusi/Sekolah/Kampus
                        </label>
                        <input type="text" name="institusi" id="institusi" 
                               value="{{ old('institusi', $user->institusi) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('institusi') border-red-500 @enderror">
                        @error('institusi')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Field: Pekerjaan (BARU) --}}
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-briefcase mr-1 text-gray-500"></i> Pekerjaan
                        </label>
                        <input type="text" name="pekerjaan" id="pekerjaan" 
                               value="{{ old('pekerjaan', $user->pekerjaan) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('pekerjaan') border-red-500 @enderror">
                        @error('pekerjaan')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Field: Provinsi (BARU) --}}
                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-gray-500"></i> Provinsi
                    </label>
                    <input type="text" name="provinsi" id="provinsi" 
                           value="{{ old('provinsi', $user->provinsi) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('provinsi') border-red-500 @enderror">
                    @error('provinsi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <h4 class="text-lg font-semibold text-gray-700 pt-4 pb-2 border-t mt-4">Pengaturan Admin</h4>

                {{-- Field: Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user-tag mr-1 text-gray-500"></i> Role Akun
                    </label>
                    <select name="role" id="role" required
                             class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 @error('role') border-red-500 @enderror">
                        <option value="peserta" {{ old('role', $user->role) == 'peserta' ? 'selected' : '' }}>Peserta</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Field: Reset Password (Opsional) --}}
                <div class="pt-4 border-t border-gray-100">
                    <p class="text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key mr-1 text-gray-500"></i> Reset Password (Opsional)
                    </p>
                    <p class="text-xs text-gray-500">Isi field di bawah jika Anda ingin mengubah password. Minimal 8 karakter.</p>
                    <input type="password" name="password" placeholder="Password Baru"
                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Tombol Submit --}}
                <div class="flex justify-between items-center pt-6">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                         <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection