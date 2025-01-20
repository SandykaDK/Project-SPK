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
                            <label for="id_kriteria">ID Kriteria:</label>
                            <input type="text" id="id_kriteria" name="id_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                        </div>
                        <div>
                            <label for="nama_kriteria">Nama Kriteria:</label>
                            <input type="text" id="nama_kriteria" name="nama_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                        </div>
                        <div>
                            <label for="bobot_kriteria">Bobot Kriteria:</label>
                            <input type="number" step="0.01" id="bobot_kriteria" name="bobot_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                            @if ($errors->has('bobot_kriteria'))
                                <span class="text-red-500">{{ $errors->first('bobot_kriteria') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="tipe_kriteria">Tipe Kriteria:</label>
                            <select id="tipe_kriteria" name="tipe_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg mb-5" required>
                                <option value="Benefit">Benefit</option>
                                <option value="Cost">Cost</option>
                            </select>
                        </div>
                        <div>
                            <label for="detail_kriteria">Detail Kriteria:</label>
                            <div id="detail_kriteria_container">
                                <div class="flex space-x-2 mb-5">
                                    <input type="text" name="detail_kriteria[0][definisi]" placeholder="Definisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                    <input type="number" name="detail_kriteria[0][nilai]" placeholder="Nilai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                </div>
                            </div>
                            <button type="button" id="add_detail_kriteria" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Tambah Detail</button>
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

    <script>
    let detailIndex = 1;
    document.getElementById('add_detail_kriteria').addEventListener('click', function() {
        var container = document.getElementById('detail_kriteria_container');
        if (detailIndex < 4) {
            var div = document.createElement('div');
            div.className = 'flex space-x-2 mb-5';
            div.innerHTML = `
                <input type="text" name="detail_kriteria[${detailIndex}][definisi]" placeholder="Definisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                <input type="number" name="detail_kriteria[${detailIndex}][nilai]" placeholder="Nilai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
            `;
            container.appendChild(div);
            detailIndex++;
        } else {
            alert('Maksimal 4 detail kriteria.');
        }
    });
    </script>
</x-app-layout>
