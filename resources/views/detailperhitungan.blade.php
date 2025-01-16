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
                            {{ $mahasiswa->nama }}
                            <hr class="my-5">
                        </h3>

                        <div class="text-lg font-bold text-gray-700 mb-1">
                            Nilai Alternatif Awal
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 mt-3 mb-7">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Pendapatan Ortu (C1)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Tanggungan Ortu (C2)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Status Ortu (C3)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Prestasi (C4)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">IPK (C5)</th>
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
                            <table class="min-w-full bg-white border border-gray-300 mt-3">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Pendapatan Ortu (C1)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Tanggungan Ortu (C2)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Status Ortu (C3)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Jumlah Prestasi (C4)</th>
                                        <th class="py-2 px-4 border-b border-gray-300">IPK (C5)</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
