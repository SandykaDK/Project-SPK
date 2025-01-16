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
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-600">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="KriteriaForm" action="{{ route('updatekriteria') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        @foreach($kriteria as $k)
                            <div class="mb-4">
                                <h3 class="text-2xl">Kriteria {{ $k->id }}</h3>

                                <div>
                                    <label for="nama_kriteria_{{ $k->id }}">Nama Kriteria:</label>
                                    <input type="text" id="nama_kriteria_{{ $k->id }}" name="nama_kriteria[{{ $k->id }}]" value="{{ $k->nama_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                </div>

                                <div>
                                    <label for="bobot_kriteria_{{ $k->id }}">Bobot Kriteria:</label>
                                    <input type="number" id="bobot_kriteria_{{ $k->id }}" name="bobot_kriteria[{{ $k->id }}]" value="{{ $k->bobot_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" step="0.01" required>
                                </div>

                                <div>
                                    <label for="tipe_kriteria_{{ $k->id }}">Tipe Kriteria:</label>
                                    <select id="tipe_kriteria_{{ $k->id }}" name="tipe_kriteria[{{ $k->id }}]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                        <option value="Benefit" {{ $k->tipe_kriteria == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                        <option value="Cost" {{ $k->tipe_kriteria == 'Cost' ? 'selected' : '' }}>Cost</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-3 rounded ">
                                Update
                            </button>

                            <a href="{{ route('kriteria') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
