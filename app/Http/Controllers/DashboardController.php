<?php

namespace App\Http\Controllers;

use App\Models\Ipk;
use App\Models\Jurusan;
use Nette\Utils\Random;
use App\Models\Kriteria;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Models\Alternatif;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function tampilDashboard()
    {
        $mahasiswa = Mahasiswa::with(['perhitungan', 'jurusan', 'alternatif'])->get();
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();
        $prestasi = Prestasi::all();
        $ipk = Ipk::all();

        $totalMahasiswa = $mahasiswa->count();
        $countByJurusan = $mahasiswa->groupBy('kode_jurusan')->map->count();
        $jurusanNames = $jurusan->pluck('nama_jurusan', 'kode_jurusan');

        $kriteriaList = Kriteria::all();
        $bobot_kriteria = $kriteriaList->pluck('bobot_kriteria', 'id_kriteria');

        foreach ($mahasiswa as $m) {
            $maxMinValues = [
                'k1' => $kriteriaList->where('id_kriteria', 'k1')->first() ? ($kriteriaList->where('id_kriteria', 'k1')->first()->tipe_kriteria == 'Benefit' ? Alternatif::max('k1') : Alternatif::min('k1')) : 'N/A',
                'k2' => $kriteriaList->where('id_kriteria', 'k2')->first() ? ($kriteriaList->where('id_kriteria', 'k2')->first()->tipe_kriteria == 'Benefit' ? Alternatif::max('k2') : Alternatif::min('k2')) : 'N/A',
                'k3' => $kriteriaList->where('id_kriteria', 'k3')->first() ? ($kriteriaList->where('id_kriteria', 'k3')->first()->tipe_kriteria == 'Benefit' ? Alternatif::max('k3') : Alternatif::min('k3')) : 'N/A',
                'k4' => $kriteriaList->where('id_kriteria', 'k4')->first() ? ($kriteriaList->where('id_kriteria', 'k4')->first()->tipe_kriteria == 'Benefit' ? Alternatif::max('k4') : Alternatif::min('k4')) : 'N/A',
                'k5' => $kriteriaList->where('id_kriteria', 'k5')->first() ? ($kriteriaList->where('id_kriteria', 'k5')->first()->tipe_kriteria == 'Benefit' ? Alternatif::max('k5') : Alternatif::min('k5')) : 'N/A',
            ];

            $normalizedValues = [
                'k1' => $maxMinValues['k1'] != 'N/A' ? $m->alternatif->k1 / $maxMinValues['k1'] : 0,
                'k2' => $maxMinValues['k2'] != 'N/A' ? $m->alternatif->k2 / $maxMinValues['k2'] : 0,
                'k3' => $maxMinValues['k3'] != 'N/A' ? $m->alternatif->k3 / $maxMinValues['k3'] : 0,
                'k4' => $maxMinValues['k4'] != 'N/A' ? $m->alternatif->k4 / $maxMinValues['k4'] : 0,
                'k5' => $maxMinValues['k5'] != 'N/A' ? $m->alternatif->k5 / $maxMinValues['k5'] : 0,
            ];

            $preferenceValues = [
                'k1' => $normalizedValues['k1'] * $bobot_kriteria['k1'],
                'k2' => $normalizedValues['k2'] * $bobot_kriteria['k2'],
                'k3' => $normalizedValues['k3'] * $bobot_kriteria['k3'],
                'k4' => $normalizedValues['k4'] * $bobot_kriteria['k4'],
                'k5' => $normalizedValues['k5'] * $bobot_kriteria['k5'],
            ];

            $hasil = array_sum($preferenceValues);

            Perhitungan::updateOrCreate(
                ['nim' => $m->nim],
                [
                    'normalisasi1' => $normalizedValues['k1'],
                    'normalisasi2' => $normalizedValues['k2'],
                    'normalisasi3' => $normalizedValues['k3'],
                    'normalisasi4' => $normalizedValues['k4'],
                    'normalisasi5' => $normalizedValues['k5'],
                    'preferensi1' => $preferenceValues['k1'],
                    'preferensi2' => $preferenceValues['k2'],
                    'preferensi3' => $preferenceValues['k3'],
                    'preferensi4' => $preferenceValues['k4'],
                    'preferensi5' => $preferenceValues['k5'],
                    'hasil' => $hasil,
                ]
            );

            $m->hasil = $hasil;
        }

        $perhitungan = Perhitungan::orderBy('hasil', 'desc')->get();
        $rankings = $perhitungan->pluck('nim')->flip()->map(fn($index) => $index + 1);

        // Urutkan mahasiswa berdasarkan ranking
        $mahasiswa = $mahasiswa->sortBy(fn($m) => $rankings[$m->nim] ?? PHP_INT_MAX);

        return view('dashboard', compact('mahasiswa', 'kriteria', 'jurusan', 'prestasi', 'ipk', 'totalMahasiswa', 'countByJurusan', 'jurusanNames', 'rankings'));
    }

    public function tampilJurusan($kode_jurusan)
    {
        $mahasiswa = Mahasiswa::where('kode_jurusan', $kode_jurusan)->with(['perhitungan', 'jurusan', 'alternatif'])->get();

        $perhitungan = Perhitungan::whereIn('nim', $mahasiswa->pluck('nim'))->orderBy('hasil', 'desc')->get();

        $rankings = $perhitungan->pluck('nim')->flip()->map(fn($index) => $index + 1);

        foreach ($mahasiswa as $m) {
            $m->hasil = optional($m->perhitungan)->hasil;
            $m->ranking = $rankings[$m->nim] ?? 'N/A';
        }

        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->first();

        $mahasiswa = $mahasiswa->sortBy(fn($m) => $rankings[$m->nim] ?? PHP_INT_MAX);

        return view('jurusan', compact('mahasiswa', 'jurusan'));
    }

    public function tampilKriteria()
    {
        $kriteria = Kriteria::all();
        return view('kriteria', compact('kriteria'));
    }

    public function tampilPerhitungan()
    {
        $mahasiswa = Mahasiswa::with('jurusan')->get();
        return view('perhitungan', compact('mahasiswa'));
    }

    public function detailPerhitungan($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan', 'ipk', 'prestasi', 'alternatif')->findOrFail($id);

        $kriteria = Kriteria::all();
        $nama_kriteria = $kriteria->pluck('nama_kriteria');
        $bobot_kriteria = $kriteria->pluck('bobot_kriteria', 'id_kriteria');

        $maxMinValues = [
            'k1' => Alternatif::max('k1'),
            'k2' => Alternatif::max('k2'),
            'k3' => Alternatif::max('k3'),
            'k4' => Alternatif::max('k4'),
            'k5' => Alternatif::max('k5'),
        ];

        $normalizedValues = [
            'k1' => $maxMinValues['k1'] != 0 ? $mahasiswa->alternatif->k1 / $maxMinValues['k1'] : 0,
            'k2' => $maxMinValues['k2'] != 0 ? $mahasiswa->alternatif->k2 / $maxMinValues['k2'] : 0,
            'k3' => $maxMinValues['k3'] != 0 ? $mahasiswa->alternatif->k3 / $maxMinValues['k3'] : 0,
            'k4' => $maxMinValues['k4'] != 0 ? $mahasiswa->alternatif->k4 / $maxMinValues['k4'] : 0,
            'k5' => $maxMinValues['k5'] != 0 ? $mahasiswa->alternatif->k5 / $maxMinValues['k5'] : 0,
        ];

        $preferenceValues = [
            'k1' => $normalizedValues['k1'] * $bobot_kriteria['k1'],
            'k2' => $normalizedValues['k2'] * $bobot_kriteria['k2'],
            'k3' => $normalizedValues['k3'] * $bobot_kriteria['k3'],
            'k4' => $normalizedValues['k4'] * $bobot_kriteria['k4'],
            'k5' => $normalizedValues['k5'] * $bobot_kriteria['k5'],
        ];

        $hasil = array_sum($preferenceValues);

        Perhitungan::updateOrCreate(
            ['nim' => $mahasiswa->nim],
            [
                'normalisasi1' => $normalizedValues['k1'],
                'normalisasi2' => $normalizedValues['k2'],
                'normalisasi3' => $normalizedValues['k3'],
                'normalisasi4' => $normalizedValues['k4'],
                'normalisasi5' => $normalizedValues['k5'],
                'preferensi1' => $preferenceValues['k1'],
                'preferensi2' => $preferenceValues['k2'],
                'preferensi3' => $preferenceValues['k3'],
                'preferensi4' => $preferenceValues['k4'],
                'preferensi5' => $preferenceValues['k5'],
                'hasil' => $hasil,
            ]
        );

        $allResults = Perhitungan::orderBy('hasil', 'desc')->get();
        $ranking = $allResults->search(function ($item) use ($mahasiswa) {
            return $item->nim == $mahasiswa->nim;
        }) + 1;

        return view('detailperhitungan', compact('mahasiswa', 'maxMinValues', 'normalizedValues', 'preferenceValues', 'nama_kriteria', 'hasil', 'ranking'));
    }

    public function tambahMahasiswa()
    {
        $jurusan = Jurusan::all();
        return view('tambahmahasiswa', compact('jurusan'));
    }

    public function simpanMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:11',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'kode_jurusan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kode_jurusan' => $request->kode_jurusan,
            'alamat' => $request->alamat,
        ]);

        $alternatif = Alternatif::create([
            'id_alternatif' => Random::generate(11),
            'k1' => 0,
            'k2' => 0,
            'k3' => 0,
            'k4' => 0,
            'k5' => 0,
            'nim' => $request->nim,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil disimpan.');
    }

    public function editMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('editmahasiswa', compact('mahasiswa'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|string|max:11',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'kode_jurusan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kode_jurusan' => $request->kode_jurusan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('jurusan', ['kode_jurusan' => $mahasiswa->kode_jurusan])->with('success', 'Data mahasiswa berhasil diubah.');
    }

    public function hapusMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kode_jurusan = $mahasiswa->kode_jurusan;
        $mahasiswa->delete();

        return redirect()->route('jurusan', ['kode_jurusan' => $kode_jurusan])->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function editAlternatif($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $kriteria = Kriteria::with('detailKriteria')->get();

        return view('editalternatif', compact('alternatif', 'kriteria'));
    }

    public function updateAlternatif(Request $request, $id)
    {
        $request->validate([
            'k1' => 'required|numeric',
            'k2' => 'required|numeric',
            'k3' => 'required|numeric',
            'k4' => 'required|numeric',
            'k5' => 'required|numeric',
        ]);

        $alternatif = Alternatif::findOrFail($id);

        $alternatif->update([
            'k1' => $request->k1,
            'k2' => $request->k2,
            'k3' => $request->k3,
            'k4' => $request->k4,
            'k5' => $request->k5,
        ]);
        return redirect()->route('dashboard')->with('success', 'Data alternatif berhasil diubah.');
    }

    public function editKriteria($id_kriteria)
    {
        $kriteria = Kriteria::findOrFail($id_kriteria);
        return view('editkriteria', compact('kriteria'));
    }

    public function updateKriteria(Request $request, $id_kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
            'bobot_kriteria' => 'required|numeric',
            'tipe_kriteria' => 'required|string|in:Benefit,Cost',
            'detail_kriteria' => 'required|array|max:4',
            'detail_kriteria.*.definisi' => 'required|string|max:255',
            'detail_kriteria.*.nilai' => 'required|numeric',
        ]);

        $kriteria = Kriteria::findOrFail($id_kriteria);
        $totalBobot = Kriteria::where('id_kriteria', '!=', $id_kriteria)->sum('bobot_kriteria') + $request->bobot_kriteria;

        if ($totalBobot > 1) {
            return redirect()->back()->withErrors(['bobot_kriteria' => 'Total bobot kriteria tidak boleh lebih dari 1.']);
        }

        $kriteria->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot_kriteria' => $request->bobot_kriteria,
            'tipe_kriteria' => $request->tipe_kriteria,
        ]);

        $kriteria->detailKriteria()->delete();
        foreach ($request->detail_kriteria as $detail) {
            $kriteria->detailKriteria()->create([
                'definisi' => $detail['definisi'],
                'nilai' => $detail['nilai'],
            ]);
        }

        return redirect()->route('kriteria')->with('success', 'Data kriteria berhasil diubah.');
    }

    public function tambahKriteria()
    {
        return view('tambahkriteria');
    }

    public function simpanKriteria(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required|string|max:255|unique:kriteria,id_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot_kriteria' => 'required|numeric',
            'tipe_kriteria' => 'required|string|in:Benefit,Cost',
            'detail_kriteria' => 'required|array|max:4',
            'detail_kriteria.*.definisi' => 'required|string|max:255',
            'detail_kriteria.*.nilai' => 'required|numeric',
        ]);

        $totalBobot = Kriteria::sum('bobot_kriteria') + $request->bobot_kriteria;

        if ($totalBobot > 1) {
            return redirect()->back()->withErrors(['bobot_kriteria' => 'Total bobot kriteria tidak boleh lebih dari 1.']);
        }

        $kriteria = Kriteria::create([
            'id_kriteria' => $request->id_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot_kriteria' => $request->bobot_kriteria,
            'tipe_kriteria' => $request->tipe_kriteria,
        ]);

        foreach ($request->detail_kriteria as $detail) {
            $kriteria->detailKriteria()->create([
                'definisi' => $detail['definisi'],
                'nilai' => $detail['nilai'],
            ]);
        }

        return redirect()->route('kriteria')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function hapusKriteria($id_kriteria)
    {
        $kriteria = Kriteria::findOrFail($id_kriteria);
        $kriteria->delete();

        return redirect()->route('kriteria')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
