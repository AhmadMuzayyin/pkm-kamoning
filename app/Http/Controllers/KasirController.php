<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KasirController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with('pendaftaran.kunjungan')->get();
        return view('pages.kasir.index', compact('pembayarans'));
    }
    public function prosesPembayaran($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembayaran' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $pembayaran = Pembayaran::findOrFail($id);
        $jumlahBayar = $request->pembayaran;
        $kembalian = $jumlahBayar - $pembayaran->total_harga;

        // Update data pembayaran
        $pembayaran->pembayaran = $jumlahBayar;
        $pembayaran->kembalian = $kembalian;
        $pembayaran->status = 'Lunas';
        $pembayaran->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diproses',
        ]);
    }

    public function detail($id)
    {
        $pembayaran = Pembayaran::with([
            'pendaftaran.kunjungan',
            'pendaftaran.pemeriksaan',
            'pendaftaran.fisik',
            'pendaftaran.tindakan',
            'pendaftaran.resep.obat'
        ])->findOrFail($id);

        // Validasi resep obat
        $validResep = collect();
        if ($pembayaran->pendaftaran && $pembayaran->pendaftaran->resep) {
            foreach ($pembayaran->pendaftaran->resep as $resep) {
                if (is_object($resep) && is_object($resep->obat)) {
                    $validResep->push($resep);
                }
            }
        }

        // Pass valid resep to view
        return view('pages.kasir.detail-partial', compact('pembayaran', 'validResep'));
    }
    public function printPreview($id)
    {
        $pembayaran = Pembayaran::with([
            'pendaftaran.kunjungan',
            'pendaftaran.pemeriksaan',
            'pendaftaran.fisik',
            'pendaftaran.tindakan',
            'pendaftaran.resep.obat'
        ])->findOrFail($id);

        return view('pages.kasir.print-template', compact('pembayaran'));
    }
}
