<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function getKendaraan()
    {
        $data = Kendaraan::where('status', 1)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message' => 'No active vehicles found.',
                'data' => []
            ]);
        }

        return response()->json([
            'message' => 'Active vehicles retrieved successfully.',
            'data' => $data
        ], 200);
    }

    public function storeKendaraan(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'kode'  => 'required|string|max:100',
            'nama'  => 'required|string|max:100',
            'jenis' => 'required|string',
            'nomor' => 'required|string',
        ]);

        // 2. Simpan data
        $kendaraan = new Kendaraan();
        $kendaraan->kode        = strtoupper($request->input('kode'));
        $kendaraan->kendaraan   = strtoupper($request->input('nama'));
        $kendaraan->jenis       = strtoupper($request->input('jenis'));
        $kendaraan->nomor       = strtoupper($request->input('nomor'));
        $kendaraan->save();

        return response()->json([
            'status'    => 201,
            'success'   => true,
            'message'   => 'Kendaraan created successfully',
            'data'      => $kendaraan
        ], 201);
    }

    public function editKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Kendaraan not found',
                'data'      => null
            ]);
        }

        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Kendaraan retrieved successfully',
            'data'      => $kendaraan
        ], 200);
    }

    public function updateKendaraan(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'editkode'  => 'required|string|max:100',
            'editnama'  => 'required|string|max:100',
            'editjenis' => 'required|string',
            'editnomor' => 'required|string',
        ]);

        // 2. Update data
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Kendaraan not found',
                'data'      => null
            ]);
        }

        $kendaraan->kode        = strtoupper($request->input('editkode'));
        $kendaraan->kendaraan   = strtoupper($request->input('editnama'));
        $kendaraan->jenis       = strtoupper($request->input('editjenis'));
        $kendaraan->nomor       = strtoupper($request->input('editnomor'));
        $kendaraan->save();

        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Kendaraan updated successfully',
            'data'      => $kendaraan
        ], 200);
    }

    public function deleteKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);
        if (!$kendaraan) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Kendaraan not found',
                'data'      => null
            ]);
        }

        $kendaraan->status = 0; // Soft delete
        $kendaraan->save();

        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message'   => 'Kendaraan deleted successfully',
            'data'      => null
        ], 200);
    }
}
