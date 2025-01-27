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
                    <div class="mt-2 flex justify-between items-center">
                        <a href="{{ route('tambahmahasiswa') }}" class="btn-tambah bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Mahasiswa
                        </a>
                        <div class="flex space-x-4">
                            <div class="relative">
                                <input type="text" id="search" placeholder="Cari Mahasiswa..." class="px-4 py-2 border rounded-lg w-64">
                                <svg class="absolute top-2 right-2 h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <div class="relative">
                                <form action="{{ route('jurusan', ['kode_jurusan' => $jurusan->kode_jurusan]) }}" method="GET">
                                    <select id="filterYear" name="year" class="px-4 py-2 border rounded-lg w-64" onchange="this.form.submit()">
                                        <option value="">Semua Periode</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id_periode }}" {{ $selectedYear == $year->id_periode ? 'selected' : '' }}>
                                                {{ $year->tahun_periode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full bg-white border border-gray-300 mt-5">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-300">NIM</th>
                                    <th class="py-2 px-4 border-b border-gray-300">Nama</th>
                                    <th class="py-2 px-4 border-b border-gray-300">Prodi</th>
                                    <th class="py-2 px-4 border-b border-gray-300">Hasil</th>
                                    <th class="py-2 px-4 border-b border-gray-300">Ranking</th>
                                    <th class="py-2 px-4 border-b border-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody id="mahasiswaTable">
                                @foreach ($mahasiswa->sortByDesc('hasil') as $index => $m)
                                    <tr class="hover:bg-gray-100 text-center" data-year="{{ $m->alternatif->periode->tahun_periode ?? 'N/A' }}">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $m->nim }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $m->nama }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $m->jurusan->nama_jurusan ?? 'Tidak ada jurusan' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $m->hasil ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">
                                            <a href="{{ route('editmahasiswa', ['id' => $m->id]) }}" class="btn-edit bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Detail</a>
                                            <a href="{{ route('editalternatif', ['id' => $m->id]) }}" class="btn-nilai bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 mx-0.5">Nilai</a>
                                            <form action="{{ route('hapusmahasiswa', ['id' => $m->id]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-hapus bg-red-500 hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded mb-4 mx-0.5">Hapus</button>
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
</x-app-layout>

<script>
    document.getElementById('search').addEventListener('keyup', function() {
        var searchText = this.value.toLowerCase();
        var rows = document.querySelectorAll('#mahasiswaTable tr');
        rows.forEach(function(row) {
            var nama = row.cells[1].textContent.toLowerCase();
            var nim = row.cells[0].textContent.toLowerCase();
            if (nama.includes(searchText) || nim.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('filterYear').addEventListener('change', function() {
        this.form.submit();
    });

    // Recalculate rankings on page load
    window.onload = function() {
        recalculateRankings();
    };

    function recalculateRankings() {
        fetch('{{ route('recalculateRankings') }}')
            .then(response => response.json())
            .then(data => {
                console.log('Rankings recalculated:', data);
                updateRankings(data.rankings);
            })
            .catch(error => {
                console.error('Error recalculating rankings:', error);
            });
    }

    function updateRankings(rankings) {
        const rows = document.querySelectorAll('#mahasiswaTable tr');
        rows.forEach((row, index) => {
            row.querySelector('td:nth-child(5)').innerText = index + 1;
        });
    }
</script>
