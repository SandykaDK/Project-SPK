<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perhitungan SAW') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-2">
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
                                                <a href="{{ route('detailperhitungan', ['id' => $m->id]) }}" class="btn-edit bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Detail</a>
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
