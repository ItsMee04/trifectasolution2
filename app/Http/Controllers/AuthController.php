<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Lakukan percobaan login
        if (Auth::attempt($credentials)) {

            /** @var \App\Models\User $user */
            $user = Auth::user(); // Ambil instance user yang sedang login

            // Pastikan status aktif
            if ($user->status != 1) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'User Account Belum Aktif!'
                ], 401);
            }

            // SEBELUM MEMANGGIL load(), PASTIKAN RELASI ADA DI MODEL USER
            // Eager load relasi untuk menghindari N+1 query
            $user->load(['pegawai', 'role']);

            // Set session menggunakan data yang sudah di-load
            Session::put([
                'nama'    => $user->pegawai->nama ?? 'No Name',
                'image'   => $user->pegawai->image ?? 'default.png',
                'role'    => $user->role->role ?? '-',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil, Mengalihkan...',
                'redirect' => url('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau Password salah!'
        ], 401);
    }

    public function logout(Request $request)
    {
        // 1. Proses Logout dari Auth Laravel
        Auth::logout();

        // 2. Hapus semua data Session (termasuk nama, role, jabatan tadi)
        $request->session()->invalidate();

        // 3. Generate ulang token CSRF agar tidak bisa dipakai ulang
        $request->session()->regenerateToken();

        // 4. Redirect ke halaman login dengan pesan sukses
        return redirect('/')->with('success-message', 'Anda telah berhasil logout.');
    }
}
