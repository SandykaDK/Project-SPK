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
    Log::info('Request data:', $request->all());

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
    Log::info('Request data:', $request->all());

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
