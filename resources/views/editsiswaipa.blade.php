<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Siswa IPA') }}
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
                                <option value="L" {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                        <div class="flex justify-end space-x-4 mt-4">
                            <button type="submit" class="btn-update bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Update</button>
                            <a href="{{ route('ipa') }}" class="btn-cancel bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900" id="subjects">
                    <div class="text-lg font-bold text-gray-700 mb-5">
                        EDIT NILAI JURUSAN IPA
                    </div>
                    <div>
                        <label for="b_inggris" class="block text-lg font-medium text-gray-700 mt-5">Bahasa Inggris:</label>
                        <input type="text" id="b_inggris" name="b_inggris" value="{{ $nilai->b_inggris }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="matematika" class="block text-lg font-medium text-gray-700 mt-5">Matematika:</label>
                        <input type="text" id="matematika" name="matematika" value="{{ $nilai->matematika }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="fisika" class="block text-lg font-medium text-gray-700 mt-5">Fisika:</label>
                        <input type="text" id="fisika" name="fisika" value="{{ $nilai->fisika }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="kimia" class="block text-lg font-medium text-gray-700 mt-5">Kimia:</label>
                        <input type="text" id="kimia" name="kimia" value="{{ $nilai->kimia }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                    <div>
                        <label for="biologi" class="block text-lg font-medium text-gray-700 mt-5">Biologi:</label>
                        <input type="text" id="biologi" name="biologi" value="{{ $nilai->biologi }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
