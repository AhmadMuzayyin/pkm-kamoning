<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FarmasiController extends Controller
{
    public function pasien()
    {
        $pasiens = Pendaftaran::with('kunjungan')->get();
        return view('pages.farmasi.pasien', compact('pasiens'));
    }
    public function obat()
    {
        $obats = Obat::all();
        return view('pages.farmasi.obat', compact('obats'));
    }
    public function store(Request $request)
    {
        // Validation logic sudah ada di validateObat
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:obats,nama',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $obat = Obat::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data obat berhasil ditambahkan',
            'data' => $obat
        ]);
    }
    public function update(Request $request, Obat $obat)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:obats,nama,' . $obat->id,
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $obat->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data obat berhasil diperbarui',
            'data' => $obat
        ]);
    }
    public function validateObat(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255|unique:obats,nama',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date'
        ];

        // Jika ada ID, berarti ini untuk update
        if ($request->has('id') && $request->id) {
            $rules['nama'] = 'required|string|max:255|unique:obats,nama,' . $request->id;
        }

        // Hanya validasi field tertentu jika request tidak memiliki semua field
        $fieldsToValidate = [];
        foreach ($rules as $field => $rule) {
            if ($request->has($field)) {
                $fieldsToValidate[$field] = $rule;
            }
        }

        $validator = Validator::make($request->all(), $fieldsToValidate);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Jika hanya validasi, kembalikan sukses
        if ($request->has('_validate_only')) {
            return response()->json(['message' => 'Validation passed']);
        }
    }
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->back()->with('success', 'Data obat berhasil dihapus');
    }
    public function search(Request $request)
    {
        $term = $request->get('term');

        if (empty($term) || strlen($term) < 3) {
            return response()->json([
                'success' => false,
                'message' => 'Masukkan minimal 3 karakter untuk mencari'
            ]);
        }

        $obat = Obat::where('nama', 'like', "%{$term}%")
            ->where('stok', '>', 0)
            ->first();

        if ($obat) {
            return response()->json([
                'success' => true,
                'obat' => $obat
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Obat tidak ditemukan atau stok habis'
        ]);
    }
}
