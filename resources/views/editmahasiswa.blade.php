<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="mahasiswaForm" action="{{ route('updatemahasiswa', $mahasiswa->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="text-2xl font-bold text-gray-700 mb-5">
                            PROFIL MAHASISWA
                        </div>
                        <div>
                            <label for="nim">NIM:</label>
                            <input type="text" id="nim" name="nim" value="{{ $mahasiswa->nim }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" value="{{ $mahasiswa->nama }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kode_jurusan">Jurusan:</label>
                            <select id="kode_jurusan" name="kode_jurusan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="S1SI" {{ $mahasiswa->kode_jurusan == 'S1SI' ? 'selected' : '' }}>S1 Sistem Informasi</option>
                                <option value="S1TK" {{ $mahasiswa->kode_jurusan == 'S1TK' ? 'selected' : '' }}>S1 Teknik Komputer</option>
                                <option value="D3SI" {{ $mahasiswa->kode_jurusan == 'D3SI' ? 'selected' : '' }}>D3 Sistem Informasi</option>
                            </select>
                        </div>
                        <div>
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" value="{{ $mahasiswa->alamat }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div class="flex justify-left space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                            <a href="{{ route('dashboard', ['kode_jurusan' => $mahasiswa->kode_jurusan]) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
