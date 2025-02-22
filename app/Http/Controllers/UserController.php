<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Kepala Rekam Medik,Farmasi,Kasir,Dokter,Petugas Loket',
        ]);

        User::create($validated);

        return redirect()->route('user.index')
            ->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:Kepala Rekam Medik,Farmasi,Kasir,Dokter,Petugas Loket',
        ];

        // Hanya validasi password jika diisi
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $validated = $request->validate($rules);

        // Hash password jika diisi
        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        // Cek jika ini bukan user yang sedang login
        if (auth()->id() == $user->id) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang aktif');
        }

        $user->delete();

        return redirect()->back()
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
