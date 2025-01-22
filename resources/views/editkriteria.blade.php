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
                    <form action="{{ route('updatekriteria', ['id' => $kriteria->id_kriteria]) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="font-bold text-2xl mb-4">
                            Kriteria
                        </div>
                        <div>
                            <label for="nama_kriteria" class>Nama Kriteria:</label>
                            <input type="text" id="nama_kriteria" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                        </div>

                        <div>
                            <label for="bobot_kriteria">Bobot Kriteria:</label>
                            <input type="number" id="bobot_kriteria" name="bobot_kriteria" value="{{ $kriteria->bobot_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" step="0.01" required>
                            @if ($errors->has('bobot_kriteria'))
                                <span class="text-red-500">{{ $errors->first('bobot_kriteria') }}</span>
                            @endif
                        </div>

                        <div>
                            <label for="tipe_kriteria">Tipe Kriteria:</label>
                            <select id="tipe_kriteria" name="tipe_kriteria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                <option value="Benefit" {{ $kriteria->tipe_kriteria == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="Cost" {{ $kriteria->tipe_kriteria == 'Cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>

                        <br><hr><br>

                        <div>
                            <label for="detail_kriteria" class="text-2xl font-bold">Detail Kriteria:</label>
                            <div id="detail_kriteria_container" class="mt-4">
                                @foreach ($kriteria->detailKriteria as $index => $detail)
                                    <div class="flex space-x-2 mb-5">
                                        <input type="text" name="detail_kriteria[{{ $index }}][definisi]" value="{{ $detail->definisi }}" placeholder="Definisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                        <input type="number" name="detail_kriteria[{{ $index }}][nilai]" value="{{ $detail->nilai }}" placeholder="Nilai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add_detail_kriteria" class="bg-green-500 hover:bg-green-700 text-white text-xl font-bold py-1 px-3 rounded">+</button>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3 mx-3">
                                {{ __('Update') }}
                            </x-primary-button>

                            <a href="{{ route('kriteria') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1.5 px-3.5 rounded-lg">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let detailIndex = {{ count($kriteria->detailKriteria) }};
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
