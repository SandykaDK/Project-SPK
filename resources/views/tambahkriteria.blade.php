<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kriteria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('simpankriteria') }}" method="POST">
                        @csrf
                        <div>
                            <label for="kode_kriteria">Kode Kriteria:</label>
                            <input type="text" id="kode_kriteria" name="kode_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                        </div>
                        <div>
                            <label for="nama_kriteria">Nama Kriteria:</label>
                            <input type="text" id="nama_kriteria" name="nama_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                        </div>
                        <div>
                            <label for="bobot">Bobot:</label>
                            <input type="number" step="0.01" id="bobot" name="bobot" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                        </div>

                        <div class="flex justify-left space-x-2 mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
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
