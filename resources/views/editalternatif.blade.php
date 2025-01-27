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

                        @foreach($kriteria as $k)
                            <div>
                                <label for="{{ $k->id_kriteria }}">{{ $k->nama_kriteria }}:</label>
                                <select id="{{ $k->id_kriteria }}" name="{{ $k->id_kriteria }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                    @foreach($k->detailKriteria as $detail)
                                        <option value="{{ $detail->nilai }}" {{ $alternatif[$k->id_kriteria] == $detail->nilai ? 'selected' : '' }}>
                                            {{ $detail->definisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach

                        <div>
                            <label for="tahun">Tahun Periode:</label>
                            <select id="tahun" name="tahun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg" required>
                                @foreach($periode as $p)
                                    <option value="{{ $p->id_periode }}" {{ $alternatif->id_periode == $p->id_periode ? 'selected' : '' }}>
                                        {{ $p->tahun_periode }}
                                    </option>
                                @endforeach
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
