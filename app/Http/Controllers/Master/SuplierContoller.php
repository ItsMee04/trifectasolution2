<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Suplier;
use App\Http\Controllers\Controller;

class SuplierContoller extends Controller
{
    public function getSuplier()
    {
        $data = Suplier::where('status', 1)->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message' => 'No active suppliers found.',
                'data' => [],
            ]);
        }
        return response()->json([
            'status'    => 200,
            'success'   => true,
            'message' => 'Active suppliers retrieved successfully.',
            'data' => $data,
        ], 200);
    }

    public function storeSuplier(Request $request)
    {
        $request->validate([
            'kode'      => 'required|string|max:255',
            'nama'      => 'required|string|max:255',
            'kontak'    => 'required|string|max:255',
            'alamat'    => 'required|string|max:500',
        ]);

        $suplier = Suplier::create([
            'kode' => strtoupper($request->kode),
            'nama' => strtoupper($request->nama),
            'kontak' => strtoupper($request->kontak),
            'alamat' => strtoupper($request->alamat),
        ]);

        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => 'Suplier created successfully.',
            'data' => $suplier
        ], 201);
    }

    public function editSuplier($id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Suplier not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Suplier retrieved successfully.',
            'data' => $suplier
        ], 200);
    }

    public function updateSuplier(Request $request, $id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Suplier not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'editkode'      => 'required|string|max:255',
            'editnama'      => 'required|string|max:255',
            'editkontak'    => 'required|string|max:255',
            'editalamat'    => 'required|string|max:500',
        ]);

        $suplier->update([
            'kode' => strtoupper($request->editkode),
            'nama' => strtoupper($request->editnama),
            'kontak' => strtoupper($request->editkontak),
            'alamat' => strtoupper($request->editalamat),
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Suplier updated successfully.',
            'data' => $suplier
        ], 200);
    }

    public function deleteSuplier($id)
    {
        $suplier = Suplier::find($id);

        if (!$suplier) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Suplier not found.',
                'data' => null
            ], 404);
        }

        $suplier->update(['status' => 0]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Suplier deleted successfully.',
            'data' => null
        ], 200);
    }
}
