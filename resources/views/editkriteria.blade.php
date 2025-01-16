<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kriteria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="KriteriaForm" action="{{ route('updatekriteria', $kriteria->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="text-2xl font-bold text-gray-700 mb-5">
                            Edit Kriteria
                        </div>

                        <div>
                            <label for="nama_kriteria">Nama Kriteria:</label>
                            <input type="text" id="nama_kriteria" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>

                        <div>
                            <label for="bobot_kriteria">Bobot Kriteria:</label>
                            <input type="number" id="bobot_kriteria" name="bobot_kriteria" value="{{ $kriteria->bobot_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>

                        <div>
                            <label for="tipe_kriteria">Tipe Kriteria:</label>
                            <select id="tipe_kriteria" name="tipe_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="benefit" {{ $kriteria->tipe_kriteria == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost" {{ $kriteria->tipe_kriteria == 'cost' ? 'selected' : '' }}>Cost</option>
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
