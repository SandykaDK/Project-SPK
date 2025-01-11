<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Siswa IPS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
                        @csrf
                        <div class="text-2xl font-bold mb-5">
                            PROFIL SISWA
                        </div>
                        <div>
                            <label for="id_siswa">ID Siswa:</label>
                            <input type="text" id="id_siswa" name="id_siswa" value="{{ $siswa->id_siswa }}" readonly>
                        </div>
                        <div>
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" required>
                        </div>
                        <div>
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="jurusan">Jurusan:</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ $siswa->jurusan }}" required>
                        </div>
                        <div>
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" value="{{ $siswa->alamat }}" required>
                        </div>
                        <div>
                            <label for="asal_sekolah">Asal Sekolah:</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ $siswa->asal_sekolah }}" required>
                        </div>
                        <div>
                            <button type="submit" class="btn-update bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Update</button>
                            <a href="{{ route('ips') }}" class="btn-cancel bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900" id="subjects">
                    <div class="text-lg font-bold text-gray-700 mb-5">
                        EDIT NILAI JURUSAN IPS
                    </div>
                    <div>
                        <label for="b_inggris" class="block text-lg font-medium text-gray-700 mt-5">Bahasa Inggris:</label>
                        <input type="text" id="b_inggris" name="b_inggris" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="ekonomi" class="block text-lg font-medium text-gray-700 mt-5">Ekonomi:</label>
                        <input type="text" id="ekonomi" name="ekonomi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="sosiologi" class="block text-lg font-medium text-gray-700 mt-5">Sosiologi:</label>
                        <input type="text" id="sosiologi" name="sosiologi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="geografi" class="block text-lg font-medium text-gray-700 mt-5">Geografi:</label>
                        <input type="text" id="geografi" name="geografi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="sejarah" class="block text-lg font-medium text-gray-700 mt-5">Sejarah:</label>
                        <input type="text" id="sejarah" name="sejarah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
