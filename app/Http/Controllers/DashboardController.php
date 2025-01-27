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
use App\Models\Periode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function tampilDashboard(Request $request)
    {
        $selectedYear = $request->input('year');
        $mahasiswaQuery = Mahasiswa::with(['perhitungan', 'jurusan', 'alternatif.periode']);

        if ($selectedYear) {
            $mahasiswaQuery->whereHas('alternatif', function($query) use ($selectedYear) {
                $query->where('id_periode', $selectedYear);
            });
        }

        $mahasiswa = $mahasiswaQuery->get();
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
            $maxMinValues = [];
            $normalizedValues = [];
            $preferenceValues = [];
            foreach ($kriteriaList as $k) {
                $maxMinValues[$k->id_kriteria] = $k->tipe_kriteria == 'Benefit' ? Alternatif::max($k->id_kriteria) : Alternatif::min($k->id_kriteria);
                $normalizedValues[$k->id_kriteria] = $maxMinValues[$k->id_kriteria] != 'N/A' ? $m->alternatif->{$k->id_kriteria} / $maxMinValues[$k->id_kriteria] : 0;
                $preferenceValues[$k->id_kriteria] = $normalizedValues[$k->id_kriteria] * $bobot_kriteria[$k->id_kriteria];
            }

            $hasil = array_sum($preferenceValues);

            Perhitungan::updateOrCreate(
                ['nim' => $m->nim, 'id_periode' => $m->alternatif->id_periode], // Tambahkan id_periode
                array_merge(
                    array_combine(
                        array_map(fn($key) => 'normalisasi' . substr($key, 1), array_keys($normalizedValues)),
                        $normalizedValues
                    ),
                    array_combine(
                        array_map(fn($key) => 'preferensi' . substr($key, 1), array_keys($preferenceValues)),
                        $preferenceValues
                    ),
                    ['hasil' => $hasil]
                )
            );

            $m->hasil = $hasil;
        }

        // Recalculate rankings for all periods
        $perhitungan = Perhitungan::orderBy('hasil', 'desc')->get();
        $rankings = $perhitungan->groupBy('id_periode')->map(function ($group) {
            return $group->values()->pluck('nim')->flip()->map(fn($index) => $index + 1);
        });

        // Urutkan mahasiswa berdasarkan ranking
        $mahasiswa = $mahasiswa->sortBy(fn($m) => $rankings[$m->alternatif->id_periode][$m->nim] ?? PHP_INT_MAX);

        $years = Periode::pluck('tahun_periode', 'id_periode'); // Fetch all periods

        return view('dashboard', compact('mahasiswa', 'kriteria', 'jurusan', 'prestasi', 'ipk', 'totalMahasiswa', 'countByJurusan', 'jurusanNames', 'rankings', 'years', 'selectedYear'));
    }

    public function tampilJurusan($kode_jurusan, Request $request)
    {
        $selectedYear = $request->input('year');
        $mahasiswaQuery = Mahasiswa::where('kode_jurusan', $kode_jurusan)->with(['perhitungan', 'jurusan', 'alternatif.periode']);

        if ($selectedYear) {
            $mahasiswaQuery->whereHas('alternatif', function($query) use ($selectedYear) {
                $query->where('id_periode', $selectedYear);
            });
        }

        $mahasiswa = $mahasiswaQuery->get();

        $perhitungan = Perhitungan::whereIn('nim', $mahasiswa->pluck('nim'))
            ->where('id_periode', $selectedYear) // Tambahkan filter id_periode
            ->orderBy('hasil', 'desc')->get();
        $rankings = $perhitungan->pluck('nim')->flip()->map(fn($index) => $index + 1);

        foreach ($mahasiswa as $m) {
            $m->hasil = optional($m->perhitungan)->hasil;
            $m->ranking = $rankings[$m->nim] ?? 'N/A';
        }

        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->first();
        $years = Periode::all(); // Fetch all periods

        // Urutkan mahasiswa berdasarkan ranking
        $mahasiswa = $mahasiswa->sortBy(fn($m) => $rankings[$m->nim] ?? PHP_INT_MAX);

        return view('jurusan', compact('mahasiswa', 'jurusan', 'years', 'selectedYear'));
    }

    public function tampilKriteria()
    {
        $kriteria = Kriteria::all();
        return view('kriteria', compact('kriteria'));
    }

    public function tampilPerhitungan()
    {
        $mahasiswa = Mahasiswa::with(['jurusan', 'perhitungan'])->get();

        foreach ($mahasiswa as $m) {
            $m->hasil = optional($m->perhitungan)->hasil;
        }

        // Urutkan mahasiswa berdasarkan hasil perhitungan
        $mahasiswa = $mahasiswa->sortByDesc('hasil');

        return view('perhitungan', compact('mahasiswa'));
    }

    public function detailPerhitungan($id)
    {
        $mahasiswa = Mahasiswa::with('jurusan', 'ipk', 'prestasi', 'alternatif')->findOrFail($id);

        $kriteria = Kriteria::all();
        $nama_kriteria = $kriteria->pluck('nama_kriteria', 'id_kriteria');
        $bobot_kriteria = $kriteria->pluck('bobot_kriteria', 'id_kriteria');

        $maxMinValues = [];
        $normalizedValues = [];
        $preferenceValues = [];

        foreach ($kriteria as $k) {
            $maxMinValues[$k->id_kriteria] = $k->tipe_kriteria == 'Benefit'
                ? Alternatif::max($k->id_kriteria)
                : Alternatif::min($k->id_kriteria);

            $normalizedValues[$k->id_kriteria] = $maxMinValues[$k->id_kriteria] != 0
                ? $mahasiswa->alternatif->{$k->id_kriteria} / $maxMinValues[$k->id_kriteria]
                : 0;

            $preferenceValues[$k->id_kriteria] = $normalizedValues[$k->id_kriteria] * $bobot_kriteria[$k->id_kriteria];
        }

        $hasil = array_sum($preferenceValues);

        Perhitungan::updateOrCreate(
            ['nim' => $mahasiswa->nim, 'id_periode' => $mahasiswa->alternatif->id_periode], // Tambahkan id_periode
            array_merge(
                array_combine(
                    array_map(fn($key) => 'normalisasi' . substr($key, 1), array_keys($normalizedValues)),
                    $normalizedValues
                ),
                array_combine(
                    array_map(fn($key) => 'preferensi' . substr($key, 1), array_keys($preferenceValues)),
                    $preferenceValues
                ),
                ['hasil' => $hasil]
            )
        );

        $allResults = Perhitungan::orderBy('hasil', 'desc')->get();
        $ranking = $allResults->search(function ($item) use ($mahasiswa) {
            return $item->nim == $mahasiswa->nim;
        }) + 1;

        // Recalculate rankings for all periods
        $rankings = $allResults->groupBy('id_periode')->map(function ($group) {
            return $group->values()->pluck('nim')->flip()->map(fn($index) => $index + 1);
        });

        return view('detailperhitungan', compact('mahasiswa', 'maxMinValues', 'normalizedValues', 'preferenceValues', 'nama_kriteria', 'hasil', 'ranking', 'rankings'));
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
            'k1' => 0,
            'k2' => 0,
            'k3' => 0,
            'k4' => 0,
            'k5' => 0,
            'id_periode' => date('2k25'),
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
        $periode = Periode::all(); // Fetch all periods

        return view('editalternatif', compact('alternatif', 'kriteria', 'periode'));
    }

    public function updateAlternatif(Request $request, $id)
    {
        $request->validate([
            'k1' => 'required|numeric',
            'k2' => 'required|numeric',
            'k3' => 'required|numeric',
            'k4' => 'required|numeric',
            'k5' => 'required|numeric',
            'tahun' => 'required|string',
        ]);

        $alternatif = Alternatif::findOrFail($id);

        $alternatif->update([
            'k1' => $request->k1,
            'k2' => $request->k2,
            'k3' => $request->k3,
            'k4' => $request->k4,
            'k5' => $request->k5,
            'id_periode' => $request->tahun,
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
        $kriteria->detailKriteria()->delete(); // Delete related detailkriteria

        // Delete corresponding data in the alternatif table
        Alternatif::query()->update([
            'k' . substr($id_kriteria, 1) => null
        ]);

        $kriteria->delete();

        return redirect()->route('kriteria')->with('success', 'Data kriteria berhasil dihapus.');
    }

    public function filterByYear(Request $request)
    {
        $year = $request->input('year');
        $mahasiswa = Mahasiswa::whereHas('periode', function($query) use ($year) {
            $query->where('tahun_periode', $year);
        })->get();

        $years = Periode::getYears();

        return view('jurusan', compact('mahasiswa', 'years'));
    }

    public function recalculateRankings()
    {
        $perhitungan = Perhitungan::orderBy('hasil', 'desc')->get();
        $rankings = $perhitungan->groupBy('id_periode')->map(function ($group) {
            return $group->values()->pluck('nim')->flip()->map(fn($index) => $index + 1);
        });

        return response()->json(['rankings' => $rankings]);
    }
}
