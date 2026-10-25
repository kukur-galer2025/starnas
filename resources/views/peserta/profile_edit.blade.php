@extends('peserta.layouts.main')

@section('title', 'Edit Profil Saya')

@section('content')
    <h2 class="text-2xl font-extrabold text-gray-900 mb-6 flex items-center">
        <i class="fas fa-id-card mr-3 text-accent"></i> Perbarui Informasi Akun
    </h2>

    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <p class="text-gray-600 mb-6">Kelola detail pribadi, institusi, dan kata sandi Anda di sini.</p>

        <form action="{{ route('peserta.profile.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- === SECTION 1: DATA PERSONAL === --}}
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center"><i class="fas fa-user-circle mr-2 text-primary"></i> Informasi Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('nama_lengkap') border-red-500 @enderror">
                        @error('nama_lengkap') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email (Non-Editable)</label>
                        <input type="email" id="email" value="{{ $user->email }}" disabled class="w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm p-3 cursor-not-allowed">
                    </div>

                    <div>
                        <label for="nomor_handphone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                        <input type="text" name="nomor_handphone" id="nomor_handphone" value="{{ old('nomor_handphone', $user->nomor_handphone) }}" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('nomor_handphone') border-red-500 @enderror">
                        @error('nomor_handphone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">Pilih...</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- === SECTION 2: DATA INSTITUSI === --}}
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center"><i class="fas fa-building mr-2 text-primary"></i> Pekerjaan & Institusi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', $user->pekerjaan) }}" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('pekerjaan') border-red-500 @enderror">
                        @error('pekerjaan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="institusi" class="block text-sm font-medium text-gray-700 mb-1">Institusi/Sekolah/Kampus</label>
                        <input type="text" name="institusi" id="institusi" value="{{ old('institusi', $user->institusi) }}" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('institusi') border-red-500 @enderror">
                        @error('institusi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', $user->provinsi) }}" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-primary focus:border-primary @error('provinsi') border-red-500 @enderror">
                        @error('provinsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- === SECTION 3: UPDATE PASSWORD === --}}
            <div>
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center"><i class="fas fa-lock mr-2 text-primary"></i> Ubah Kata Sandi (Opsional)</h3>
                <p class="text-sm text-gray-500 mb-4">Isi field di bawah jika Anda ingin mengganti kata sandi Anda. Pastikan minimal 8 karakter.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-accent focus:border-accent @error('password') border-red-500 @enderror">
                        @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-accent focus:border-accent">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-md shadow-emerald-600/20 text-base font-semibold text-white bg-primary hover:bg-emerald-700 transition duration-150 transform hover:scale-[1.02]">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
@endsection