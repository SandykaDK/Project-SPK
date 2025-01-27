<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-3xl font-bold mb-5 text-center">
                        APLIKASI SELEKSI MAHASISWA PENERIMA BEASISWA<br>BEBAS BOP 100%
                    </div>
                    <!-- Cards for displaying student counts -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                            <div class="text-2xl font-bold">Total Mahasiswa</div>
                            <div class="text-4xl">{{ $totalMahasiswa }}</div>
                        </div>
                        @foreach($countByJurusan as $kodeJurusan => $count)
                            <div class="p-4 rounded-lg shadow-md text-white {{ $kodeJurusan == 'S1TK' ? 'bg-yellow-500' : ($kodeJurusan == 'D3SI' ? 'bg-red-500' : 'bg-green-500') }}">
                                <div class="text-2xl font-bold">{{ $jurusanNames[$kodeJurusan] }}</div>
                                <div class="text-4xl">{{ $count }}</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Chart.js bar chart -->
                    <div class="mt-8 mb-8">
                        <canvas id="studentsChart"></canvas>
                    </div>
                    <div class="text-3xl font-bold mt-10 mb-1 text-center">
                        Ranking Mahasiswa
                    </div>
                    <!-- Year filter dropdown -->
                    <div class="text-left">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <div class="mt-1 text-right">
                                <select id="year" name="year" class="block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="this.form.submit()">
                                    <option value="" {{ request('year') == '' ? 'selected' : '' }}>Semua Periode</option>
                                    @foreach($years as $id => $year)
                                        <option value="{{ $id }}" {{ request('year') == $id ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="mt-3">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-2">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">NIM</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Nama</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Prodi</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Hasil</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa->sortByDesc('hasil') as $index => $m)
                                        <tr class="hover:bg-gray-100 text-center">
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->nim }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->nama }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $m->jurusan->nama_jurusan ?? 'Tidak ada jurusan' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{$m->hasil ?? 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-300">{{ $index + 1 }}</td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('studentsChart').getContext('2d');
    var studentsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($jurusanNames->values()),
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: @json($countByJurusan->values()),
                backgroundColor: ['#4CAF50', '#FFEB3B', '#F44336'],
                borderColor: ['#388E3C', '#FBC02D', '#D32F2F'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Recalculate rankings on page load
    window.onload = function() {
        recalculateRankings();
    };

    // Recalculate rankings when the period filter is changed
    document.getElementById('year').addEventListener('change', function() {
        recalculateRankings();
    });

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
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.querySelector('td:nth-child(5)').innerText = index + 1;
        });
    }
</script>
