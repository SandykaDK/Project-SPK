<?php

namespace App\Http\Controllers;

use App\Models\Ipa;
use App\Models\Ips;
use App\Models\Siswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function tampilsiswa()
    {
        $siswa = Siswa::all();
        return view('dashboard', compact('siswa'));
    }

    public function tambahsiswaipa()
    {
        return view('tambahsiswaipa');
    }

    public function tambahsiswaips()
    {
        return view('tambahsiswaips');
    }

    public function simpansiswaipa(Request $request)
    {

    $request->validate([
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string|max:1',
        'jurusan' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'asal_sekolah' => 'required|string|max:255',
        'b_inggris' => 'required|int',
        'matematika' => 'required|int',
        'fisika' => 'required|int',
        'kimia' => 'required|int',
        'biologi' => 'required|int',
    ]);

    $siswa = Siswa::create([
        'id_siswa' => (string) Str::uuid(),
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'jurusan' => $request->jurusan,
        'alamat' => $request->alamat,
        'asal_sekolah' => $request->asal_sekolah,
    ]);

    Log::info('Siswa created:', $siswa->toArray());

    Ipa::create([
        'id_siswa' => $siswa->id_siswa,
        'b_inggris' => $request->b_inggris,
        'matematika' => $request->matematika,
        'fisika' => $request->fisika,
        'kimia' => $request->kimia,
        'biologi' => $request->biologi,
    ]);

    return redirect()->route('dashboard')->with('success', 'Siswa IPA berhasil ditambahkan.');
}

public function simpansiswaips(Request $request)
{

    $request->validate([
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string|max:1',
        'jurusan' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'asal_sekolah' => 'required|string|max:255',
        'b_inggris' => 'required|int',
        'ekonomi' => 'required|int',
        'sosiologi' => 'required|int',
        'geografi' => 'required|int',
        'sejarah' => 'required|int',
    ]);

    $siswa = Siswa::create([
        'id_siswa' => (string) Str::uuid(),
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'jurusan' => 'IPS',
        'alamat' => $request->alamat,
        'asal_sekolah' => $request->asal_sekolah,
    ]);

    Log::info('Siswa created:', $siswa->toArray());

    Ips::create([
        'id_siswa' => $siswa->id_siswa,
        'b_inggris' => $request->b_inggris,
        'ekonomi' => $request->ekonomi,
        'sosiologi' => $request->sosiologi,
        'geografi' => $request->geografi,
        'sejarah' => $request->sejarah,
    ]);

        return redirect()->route('dashboard')->with('success', 'Siswa IPS berhasil ditambahkan.');
    }

    public function editsiswa($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        if ($siswa->jurusan == 'IPA') {
            $nilai = Ipa::where('id_siswa', $id_siswa)->first();
            return view('editsiswaipa', compact('siswa', 'nilai'));
        } else if ($siswa->jurusan == 'IPS') {
            $nilai = Ips::where('id_siswa', $id_siswa)->first();
            return view('editsiswaips', compact('siswa', 'nilai'));
        }
    }

    public function updatesiswa(Request $request, $id_siswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'alamat' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'b_inggris' => 'required|int',
            'matematika' => 'required_if:jurusan,IPA|int',
            'fisika' => 'required_if:jurusan,IPA|int',
            'kimia' => 'required_if:jurusan,IPA|int',
            'biologi' => 'required_if:jurusan,IPA|int',
            'ekonomi' => 'required_if:jurusan,IPS|int',
            'sosiologi' => 'required_if:jurusan,IPS|int',
            'geografi' => 'required_if:jurusan,IPS|int',
            'sejarah' => 'required_if:jurusan,IPS|int',
        ]);

        $siswa = Siswa::findOrFail($id_siswa);
        $siswa->update($request->only(['nama', 'jenis_kelamin', 'alamat', 'asal_sekolah']));

        if ($siswa->jurusan == 'IPA') {
            Ipa::updateOrCreate(
                ['id_siswa' => $siswa->id_siswa],
                [
                    'b_inggris' => $request->b_inggris,
                    'matematika' => $request->matematika,
                    'fisika' => $request->fisika,
                    'kimia' => $request->kimia,
                    'biologi' => $request->biologi,
                ]
            );
        } else if ($siswa->jurusan == 'IPS') {
            Ips::updateOrCreate(
                ['id_siswa' => $siswa->id_siswa],
                [
                    'b_inggris' => $request->b_inggris,
                    'ekonomi' => $request->ekonomi,
                    'sosiologi' => $request->sosiologi,
                    'geografi' => $request->geografi,
                    'sejarah' => $request->sejarah,
                ]
            );
        }

        return redirect()->route('dashboard')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function tampilipa()
    {
        $siswa = Siswa::with('ipa')->get();
        return view('ipa', compact('siswa'));
    }

    public function tampilips()
    {
        $siswa = Siswa::with('ips')->get();
        return view('ips', compact('siswa'));
    }
}
