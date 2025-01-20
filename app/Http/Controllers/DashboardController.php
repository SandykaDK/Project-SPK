<?php

namespace App\Http\Controllers;

use App\Models\Ipk;
use App\Models\Jurusan;
use Nette\Utils\Random;
use App\Models\Kriteria;
use App\Models\Prestasi;
use App\Models\Mahasiswa;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function tampilDashboard()
    {
        $mahasiswa = Mahasiswa::all();
        $kriteria = Kriteria::all();
        $jurusan = Jurusan::all();
        $prestasi = Prestasi::all();
        $ipk = Ipk::all();

        $totalMahasiswa = $mahasiswa->count();
        $countByJurusan = $mahasiswa->groupBy('kode_jurusan')->map->count();
        $jurusanNames = $jurusan->pluck('nama_jurusan', 'kode_jurusan');

        return view('dashboard', compact('mahasiswa', 'kriteria', 'jurusan', 'prestasi', 'ipk', 'totalMahasiswa', 'countByJurusan', 'jurusanNames'));
    }

    public function tampilJurusanS1SI()
    {
        $mahasiswa = Mahasiswa::where('kode_jurusan', 'S1SI')
        ->with('ipk', 'prestasi', 'jurusan', 'periode')
        ->get();

        return view('jurusans1si', compact('mahasiswa'));
    }

    public function tampilJurusanS1TK()
    {
        $mahasiswa = Mahasiswa::where('kode_jurusan', 'S1TK')
        ->with('ipk', 'prestasi', 'jurusan', 'periode')
        ->get();

        return view('jurusans1tk', compact('mahasiswa'));
    }

    public function tampilJurusanD3SI()
    {
        $mahasiswa = Mahasiswa::where('kode_jurusan', 'D3SI')
        ->with('ipk', 'prestasi', 'jurusan', 'periode')
        ->get();

        return view('jurusand3si', compact('mahasiswa'));
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

        $kriteriaK1 = Kriteria::where('id_kriteria', 'k1')->first();
        $kriteriaK2 = Kriteria::where('id_kriteria', 'k2')->first();
        $kriteriaK3 = Kriteria::where('id_kriteria', 'k3')->first();
        $kriteriaK4 = Kriteria::where('id_kriteria', 'k4')->first();
        $kriteriaK5 = Kriteria::where('id_kriteria', 'k5')->first();

        $maxMinValues = [
            'k1' => $kriteriaK1 ? ($kriteriaK1->tipe_kriteria == 'Benefit' ? Alternatif::max('k1') : Alternatif::min('k1')) : 'N/A',
            'k2' => $kriteriaK2 ? ($kriteriaK2->tipe_kriteria == 'Benefit' ? Alternatif::max('k2') : Alternatif::min('k2')) : 'N/A',
            'k3' => $kriteriaK3 ? ($kriteriaK3->tipe_kriteria == 'Benefit' ? Alternatif::max('k3') : Alternatif::min('k3')) : 'N/A',
            'k4' => $kriteriaK4 ? ($kriteriaK4->tipe_kriteria == 'Benefit' ? Alternatif::max('k4') : Alternatif::min('k4')) : 'N/A',
            'k5' => $kriteriaK5 ? ($kriteriaK5->tipe_kriteria == 'Benefit' ? Alternatif::max('k5') : Alternatif::min('k5')) : 'N/A',
        ];

        $normalizedValues = [
            'k1' => $maxMinValues['k1'] != 'N/A' ? $mahasiswa->alternatif->k1 / $maxMinValues['k1'] : 'N/A',
            'k2' => $maxMinValues['k2'] != 'N/A' ? $mahasiswa->alternatif->k2 / $maxMinValues['k2'] : 'N/A',
            'k3' => $maxMinValues['k3'] != 'N/A' ? $mahasiswa->alternatif->k3 / $maxMinValues['k3'] : 'N/A',
            'k4' => $maxMinValues['k4'] != 'N/A' ? $mahasiswa->alternatif->k4 / $maxMinValues['k4'] : 'N/A',
            'k5' => $maxMinValues['k5'] != 'N/A' ? $mahasiswa->alternatif->k5 / $maxMinValues['k5'] : 'N/A',
        ];

        return view('detailperhitungan', compact('mahasiswa', 'maxMinValues', 'normalizedValues'));
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

        switch ($mahasiswa->kode_jurusan) {
            case 'S1SI':
                return redirect()->route('jurusans1si')->with('success', 'Data mahasiswa berhasil diubah.');
            case 'S1TK':
                return redirect()->route('jurusans1tk')->with('success', 'Data mahasiswa berhasil diubah.');
            case 'D3SI':
                return redirect()->route('jurusand3si')->with('success', 'Data mahasiswa berhasil diubah.');
            default:
                return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil diubah.');
        }
    }

    public function hapusMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('jurusans1si')->with('success', 'Data mahasiswa berhasil dihapus.');
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
