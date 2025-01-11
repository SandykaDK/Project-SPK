<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Siswa IPA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('tambahsiswaipa') }}" class="btn-tambah bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4">Tambah Siswa</a>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2">Nama</th>
                                <th class="py-2">Jenis Kelamin</th>
                                <th class="py-2">Jurusan</th>
                                <th class="py-2">Alamat</th>
                                <th class="py-2">Asal Sekolah</th>
                                <th class="py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                @if ($s->jurusan == 'IPA')
                                    <tr>
                                        <td class="py-2">{{ $s->nama }}</td>
                                        <td class="py-2">{{ $s->jenis_kelamin }}</td>
                                        <td class="py-2">{{ $s->jurusan }}</td>
                                        <td class="py-2">{{ $s->alamat }}</td>
                                        <td class="py-2">{{ $s->asal_sekolah }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('siswa.edit', $s->id_siswa) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
