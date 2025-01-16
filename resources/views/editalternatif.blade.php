<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Alternatif') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="alternatifForm" action="{{ route('updatealternatif', $alternatif->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="text-2xl font-bold text-gray-700 mb-5">
                            Edit Alternatif
                        </div>

                        <div>
                            <label for="k1">Jumlah Pendapatan Ortu:</label>
                            <select id="k1" name="k1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="4" {{ $alternatif->k1 == 4 ? 'selected' : '' }}> < Rp2.000.000 </option>
                                <option value="3" {{ $alternatif->k1 == 3 ? 'selected' : '' }}> Rp2.000.000 - Rp6.000.000 </option>
                                <option value="2" {{ $alternatif->k1 == 2 ? 'selected' : '' }}> Rp6.000.000 - Rp10.000.000 </option>
                                <option value="1" {{ $alternatif->k1 == 1 ? 'selected' : '' }}> > Rp10.000.000 </option>
                            </select>
                        </div>

                        <div>
                            <label for="k2">Jumlah Tanggungan Ortu:</label>
                            <select id="k2" name="k2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="1" {{ $alternatif->k2 == 1 ? 'selected' : '' }}> 1-2 Orang </option>
                                <option value="2" {{ $alternatif->k2 == 2 ? 'selected' : '' }}> 3-4 Orang </option>
                                <option value="3" {{ $alternatif->k2 == 3 ? 'selected' : '' }}> 5-6 Orang </option>
                                <option value="4" {{ $alternatif->k2 == 4 ? 'selected' : '' }}> >6 Orang </option>
                            </select>
                        </div>

                        <div>
                            <label for="k3">Status Ortu:</label>
                            <select id="k3" name="k3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="1" {{ $alternatif->k3 == 1 ? 'selected' : '' }}>Keduanya Masih Hidup</option>
                                <option value="2" {{ $alternatif->k3 == 2 ? 'selected' : '' }}>Hanya Ayah Yang Masih Hidup</option>
                                <option value="3" {{ $alternatif->k3 == 3 ? 'selected' : '' }}>Hanya Ibu Yang Masih Hidup</option>
                                <option value="4" {{ $alternatif->k3 == 4 ? 'selected' : '' }}>Keduanya Sudah Meninggal</option>
                            </select>
                        </div>

                        <div>
                            <label for="k4">Jumlah Prestasi:</label>
                            <select id="k4" name="k4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="1" {{ $alternatif->k4 == 1 ? 'selected' : '' }}>0</option>
                                <option value="2" {{ $alternatif->k4 == 2 ? 'selected' : '' }}>1</option>
                                <option value="3" {{ $alternatif->k4 == 3 ? 'selected' : '' }}>2</option>
                                <option value="4" {{ $alternatif->k4 == 4 ? 'selected' : '' }}>>=3</option>
                            </select>
                        </div>

                        <div>
                            <label for="k5">IPK :</label>
                            <select id="k5" name="k5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="1" {{ $alternatif->k5 == 1 ? 'selected' : '' }}>< 3.00</option>
                                <option value="2" {{ $alternatif->k5 == 2 ? 'selected' : '' }}>3.01 - 3.25</option>
                                <option value="3" {{ $alternatif->k5 == 3 ? 'selected' : '' }}>3.26 - 3.50</option>
                                <option value="4" {{ $alternatif->k5 == 4 ? 'selected' : '' }}>> 3.50</option>
                            </select>
                        </div>

                        <div class="flex justify-left space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
