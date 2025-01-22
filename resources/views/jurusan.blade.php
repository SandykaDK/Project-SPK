<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurusan ' . $jurusan->nama_jurusan) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-2">
                        <a href="{{ route('tambahmahasiswa') }}" class="btn-tambah bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Tambah Mahasiswa</a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-5">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">NIM</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Nama</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Prodi</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Hasil</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa as $index => $m)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->nim }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->nama }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->jurusan->nama_jurusan ?? 'Tidak ada jurusan' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->hasil ?? 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">
                                                <a href="{{ route('editmahasiswa', ['id' => $m->id]) }}" class="btn-edit bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Detail</a>
                                                <a href="{{ route('editalternatif', ['id' => $m->id]) }}" class="btn-nilai bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Nilai</a>
                                                <form action="{{ route('hapusmahasiswa', ['id' => $m->id]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-hapus bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
