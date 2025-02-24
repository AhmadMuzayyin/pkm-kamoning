<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoketController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::all();
        return view('pages.loket.index', compact('kunjungans'));
    }

    public function show(Kunjungan $kunjungan, Request $request)
    {
        $riwayat = $request->get('riwayat');
        $rekam_medik = null;
        if ($riwayat) {
            $rekam_medik = Pendaftaran::with('pemeriksaan', 'resep', 'tindakan', 'fisik')->where('id', $riwayat)->where('kunjungan_id', $kunjungan->id)->first();
        }
        return view('pages.loket.detail', compact('kunjungan',  'riwayat', 'rekam_medik'));
    }

    public function create()
    {
        return view('pages.loket.form', ['kunjungan' => new Kunjungan()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'telpon' => 'required|string|regex:/^08[0-9]{8,13}$/', // Format nomor HP Indonesia
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'umur' => 'required|integer|min:0|max:120', // Batasan umur 0 - 120 tahun
            'nik' => 'required|numeric|digits:16|unique:kunjungans,nik', // NIK harus 16 digit dan unik
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenis_pelayanan' => 'required|in:BPJS,Umum',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);
        try {
            $request->merge(['no_rekam_medik' => rand(10000000, 99999999)]);
            Kunjungan::create($request->all());
            return redirect()->route('loket.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Kunjungan $kunjungan)
    {
        return view('pages.loket.form', compact('kunjungan')); // Mengirim data kunjungan untuk edit
    }

    public function update(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'telpon' => 'required|string|regex:/^08[0-9]{8,13}$/', // Format nomor HP Indonesia
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'umur' => 'required|integer|min:0|max:120', // Batasan umur 0 - 120 tahun
            'nik'             => [
                'required',
                'numeric',
                'digits:16',
                Rule::unique('kunjungans')->ignore($kunjungan->id), // Agar bisa tetap menggunakan NIK yang sama
            ],
            'no_rekam_medik'  => [
                'required',
                'integer',
                Rule::unique('kunjungans')->ignore($kunjungan->id), // Agar tetap bisa pakai No. Rekam Medik yang sama
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenis_pelayanan' => 'required|in:BPJS,Umum',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);
        try {
            $kunjungan->update($request->all());
            return redirect()->route('loket.index')->with('success', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Kunjungan $kunjungan)
    {
        try {
            $kunjungan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function pendaftaran(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'jenis_bayar' => 'required|in:BPJS,Umum',
            'poli' => 'required|in:Umum,Gigi,KIA',
            'tanggal_periksa' => 'required|date|after_or_equal:today',
        ]);
        try {
            $request->merge(['kunjungan_id' => $kunjungan->id]);
            $kunjungan->pendaftaran()->create($request->all());
            return redirect('pasien?poli=' . $request['poli'])->with('success', 'Pendaftaran berhasil!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function updatePendaftaran(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'jenis_bayar' => 'required|in:BPJS,Umum',
            'poli' => 'required|in:Umum,Gigi,KIA',
            'tanggal_periksa' => 'required|date|after_or_equal:today',
        ]);

        try {
            $pendaftaran->update($request->all());
            return redirect()->back()->with('success', 'Data pendaftaran berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function destroyPendaftaran(Pendaftaran $pendaftaran)
    {
        try {
            $pendaftaran->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
