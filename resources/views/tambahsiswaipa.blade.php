<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Siswa IPA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="siswaForm" action="{{ route('siswa.simpanipa') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="text-2xl font-bold text-gray-700 mb-5">
                            PROFIL SISWA
                        </div>
                        <div>
                            <label for="nama">Nama:</label>
                            <input type="text" id="nama" name="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="jenis_kelamin">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="alamat">Alamat:</label>
                            <input type="text" id="alamat" name="alamat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="asal_sekolah">Asal Sekolah:</label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <input type="hidden" id="jurusan" name="jurusan" value="IPA">
                        </div>

                        <div class="mt-5 mb-5">
                            <br><hr><br>
                        </div>

                        <div class="text-2xl font-bold text-gray-700 mt-5 mb-5">
                            NILAI SISWA
                        </div>
                        <div>
                            <label for="b_inggris">Bahasa Inggris:</label>
                            <input type="number" id="b_inggris" name="b_inggris" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="matematika">Matematika:</label>
                            <input type="number" id="matematika" name="matematika" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="fisika">Fisika:</label>
                            <input type="number" id="fisika" name="fisika" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="kimia">Kimia:</label>
                            <input type="number" id="kimia" name="kimia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                        <div>
                            <label for="biologi">Biologi:</label>
                            <input type="number" id="biologi" name="biologi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="submit" form="siswaForm" class="btn-tambah bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
                <a href="{{ route('ipa') }}" class="btn-cancel bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
            </div>
        </div>
    </div>
</x-app-layout>
