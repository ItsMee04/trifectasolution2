<?php

namespace App\Http\Controllers\Master;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        $data = User::with(['role', 'pegawai'])->whereIn('status', [1, 2])->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Data user tidak ditemukan',
                'data' => []
            ]);
        }

        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Data user berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    public function editUsers($id)
    {
        $data = User::with(['role', 'pegawai'])->where('id', $id)->first();

        if (!$data) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Data user tidak ditemukan',
                'data' => null
            ]);
        }

        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Data user berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    public function updateUsers(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'unique'   => ':attribute sudah digunakan',
            'min'      => ':attribute minimal :min karakter'
        ];

        // Ambil data user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        // Cek apakah user sudah memiliki email dan password
        $hasEmail = !empty($user->email);
        $hasPassword = !empty($user->password);

        // Buat aturan validasi berdasarkan kondisi
        $rules = [];
        if (!$hasEmail || !$hasPassword) {
            // Jika user belum memiliki email & password (user baru)
            $rules = [
                'emailPegawai'    => 'required|unique:users,email',
                'passwordPegawai' => 'required|min:6'
            ];
        } else {
            // Jika user sudah memiliki email & password
            if ($request->emailPegawai !== $user->email) {
                // Jika email diubah, validasi email harus unik
                $rules['email'] = 'required|unique:users,email,' . $id;
            }

            if (!empty($request->passwordPegawai)) {
                // Jika password diisi, cek agar tidak sama dengan yang lama
                if (Hash::check($request->passwordPegawai, $user->password)) {
                    return response()->json(['success' => false, 'message' => 'Password baru tidak boleh sama dengan password lama.'], 400);
                }
                $rules['password'] = 'min:6';
            }
        }

        // Jalankan validasi
        $request->validate($rules, $messages);

        // Proses update data user
        $user->update([
            'email'    => $request->emailPegawai ?? $user->email,
            'password' => !empty($request->passwordPegawai) ? Hash::make($request->passwordPegawai) : $user->password,
            'role_id'  => $request->role_id ?? $user->role_id,
            'status'   => 1,
        ]);

        return response()->json(['success' => true, 'message' => "Data User Berhasil Diperbarui"]);
    }
}
