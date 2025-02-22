<?php

namespace App\Http\Controllers;

use App\Models\Fisik;
use App\Models\Obat;
use App\Models\Pembayaran;
use App\Models\Pemeriksaan;
use App\Models\Pendaftaran;
use App\Models\Resep;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $param = $request->get('poli');
        $pasiens = $this->pasien($param);
        return view('pages.pasien.index', compact('pasiens'));
    }
    public function pasien($param)
    {
        $pasiens = Pendaftaran::with('kunjungan')->where('poli', $param)->get();
        return $pasiens ?? [];
    }

    public function show(Request $request, $id)
    {
        $pasien = new Pendaftaran();
        $term = $request->get('term');
        $pasien = $pasien->with('kunjungan')
            ->where('id', $id)
            ->first();
        $rekam_medik = [];
        if ($term) {
            $rekam_medik = Pendaftaran::with('pemeriksaan', 'resep', 'tindakan', 'fisik')->where('id', $term)->where('kunjungan_id', $id)->first();
        }
        return view('pages.pasien.show', compact('pasien', 'rekam_medik'));
    }
    public function periksa($id)
    {
        $pasien = new Pendaftaran();
        $pasien->update(['status' => 'Pemeriiksaan']);
        $pasien = $pasien->with('kunjungan')
            ->where('id', $id)
            ->first();
        return view('pages.pasien.show', compact('pasien'));
    }
    public function store(Request $request, $id)
    {
        $obat_ids = [];
        $jumlah_obats = [];

        if ($request->has('obat_ids') && is_array($request->obat_ids)) {
            foreach ($request->obat_ids as $key => $obat_id) {
                if (!empty($obat_id) && isset($request->jumlah_obats[$key])) {
                    $obat_ids[] = $obat_id;
                    $jumlah_obats[] = $request->jumlah_obats[$key];
                }
            }
        }

        $request->merge([
            'obat_ids' => $obat_ids,
            'jumlah_obats' => $jumlah_obats
        ]);

        $validator = Validator::make($request->all(), [
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'suhu_tubuh' => 'required|numeric',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'required|string',
            'obat_ids' => 'required|array|min:1',
            'obat_ids.*' => 'required|exists:obats,id',
            'jumlah_obats' => 'required|array|min:1',
            'jumlah_obats.*' => 'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan pada data yang dimasukkan.');
        }

        // Cek apakah pendaftaran ada
        $pendaftaran = Pendaftaran::find($id);
        if (!$pendaftaran) {
            return redirect()->back()
                ->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // Cek ketersediaan stok untuk semua obat
        $obatIds = $request->obat_ids;
        $jumlahObats = $request->jumlah_obats;

        $obatData = [];

        for ($i = 0; $i < count($obatIds); $i++) {
            $obatId = $obatIds[$i];
            $jumlah = $jumlahObats[$i];

            $obat = Obat::find($obatId);

            if (!$obat) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Salah satu obat tidak ditemukan dalam database.');
            }

            if ($obat->stok < $jumlah) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Stok obat {$obat->nama} tidak mencukupi. Stok tersedia: {$obat->stok}");
            }

            $obatData[] = [
                'obat' => $obat,
                'jumlah' => $jumlah
            ];
        }

        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Simpan data fisik
            $fisik = new Fisik();
            $fisik->pendaftaran_id = $id;
            $fisik->tinggi_badan = $request->tinggi_badan;
            $fisik->berat_badan = $request->berat_badan;
            $fisik->suhu_tubuh = $request->suhu_tubuh;
            $fisik->save();

            // Simpan data pemeriksaan
            $pemeriksaan = new Pemeriksaan();
            $pemeriksaan->pendaftaran_id = $id;
            $pemeriksaan->keluhan = $request->keluhan;
            $pemeriksaan->diagnosa = $request->diagnosa;
            $pemeriksaan->save();

            // Simpan data tindakan
            $tindakan = new Tindakan();
            $tindakan->pendaftaran_id = $id;
            $tindakan->tindakan = $request->tindakan;
            $tindakan->save();

            // Simpan data resep obat untuk semua obat yang dipilih
            foreach ($obatData as $data) {
                $obat = $data['obat'];
                $jumlah = $data['jumlah'];

                $resep = new Resep();
                $resep->pendaftaran_id = $id;
                $resep->obat_id = $obat->id;
                $resep->jumlah = $jumlah;
                $resep->save();

                // Kurangi stok obat
                $obat->stok = $obat->stok - $jumlah;
                $obat->save();
            }

            $pendaftaran->status = 'selesai';
            $pendaftaran->save();

            $totalHarga = 0;
            foreach ($obatData as $data) {
                $obat = $data['obat'];
                $jumlah = $data['jumlah'];
                $totalHarga += $obat->harga * $jumlah;
            }

            // Buat pembayaran dengan total harga yang benar
            Pembayaran::create([
                'pendaftaran_id' => $id,
                'total_harga' => $totalHarga,
                'pembayaran' => 0,
                'kembalian' => 0,
                'status' => 'Belum Lunas'
            ]);

            DB::commit();
            return redirect()->route('pasien.index', ['poli' => $pendaftaran->poli])
                ->with('success', 'Data pemeriksaan berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
}
