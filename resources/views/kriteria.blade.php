<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kriteria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-2">
                        <a href="{{ count($kriteria) < 5 ? route('tambahkriteria') : '#' }}" class="btn-edit bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4" onclick="if ({{ count($kriteria) }} >= 5) { alert('Maksimal 5 Kriteria'); return false; }">Tambah</a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-5">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">ID Kriteria</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Nama Kriteria</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Bobot</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Tipe</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriteria as $index => $k)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $k->id_kriteria }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $k->nama_kriteria }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $k->bobot_kriteria }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $k->tipe_kriteria }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">
                                                <a href="{{ route('editkriteria', ['id' => $k->id_kriteria]) }}" class="btn-edit bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                                <form action="{{ route('hapuskriteria', ['id' => $k->id_kriteria]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')">Delete</button>
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
