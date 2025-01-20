<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Perhitungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-2">
                        <h3 class="text-xl font-bold text-gray-700 mb-9">
                            {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                            <hr class="my-5">
                        </h3>

                        <div class="text-lg font-bold text-gray-700 mb-1">
                            Nilai Alternatif Awal
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3 mb-7">
                                <thead class="bg-gray-200">
                                    <tr>
                                        @foreach ($nama_kriteria as $kriteria)
                                            <th class="py-2 px-4 border-b border-gray-300">{{ $kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $mahasiswa->alternatif->k1 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $mahasiswa->alternatif->k2 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $mahasiswa->alternatif->k3 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $mahasiswa->alternatif->k4 }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $mahasiswa->alternatif->k5 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-lg font-bold text-gray-700 mb-1">
                            Nilai Max/Min
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3 mb-7">
                                <thead class="bg-gray-200">
                                    <tr>
                                        @foreach ($nama_kriteria as $kriteria)
                                            <th class="py-2 px-4 border-b border-gray-300">{{ $kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $maxMinValues['k1'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $maxMinValues['k2'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $maxMinValues['k3'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $maxMinValues['k4'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $maxMinValues['k5'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-lg font-bold text-gray-700 mb-3">
                            Normalisasi Nilai Alternatif
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3 mb-7">
                                <thead class="bg-gray-200">
                                    <tr>
                                        @foreach ($nama_kriteria as $kriteria)
                                            <th class="py-2 px-4 border-b border-gray-300">{{ $kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $normalizedValues['k1'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $normalizedValues['k2'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $normalizedValues['k3'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $normalizedValues['k4'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $normalizedValues['k5'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-lg font-bold text-gray-700 mb-3">
                            Preferensi Nilai Alternatif
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3">
                                <thead class="bg-gray-200">
                                    <tr>
                                        @foreach ($nama_kriteria as $kriteria)
                                            <th class="py-2 px-4 border-b border-gray-300">{{ $kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $preferenceValues['k1'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $preferenceValues['k2'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $preferenceValues['k3'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $preferenceValues['k4'] }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $preferenceValues['k5'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-lg font-bold text-gray-700 mb-3">
                            Hasil Akhir
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3">
                                <thead class="bg-gray-200">
                                    <tr>
                                        @foreach ($nama_kriteria as $kriteria)
                                            <th class="py-2 px-4 border-b border-gray-300">{{ $kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ isset($preferenceValues['k1']) ? $preferenceValues['k1'] : 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ isset($preferenceValues['k2']) ? $preferenceValues['k2'] : 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ isset($preferenceValues['k3']) ? $preferenceValues['k3'] : 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ isset($preferenceValues['k4']) ? $preferenceValues['k4'] : 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ isset($preferenceValues['k5']) ? $preferenceValues['k5'] : 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-lg font-bold text-gray-700 mb-3">
                            Hasil Akhir
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">Hasil</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-100 text-center">
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $hasil }}</td>
                                        <td class="py-2 px-4 border-b border-gray-300">{{ $ranking }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
