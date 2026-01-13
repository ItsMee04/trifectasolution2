<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\Perjalanan;
use Illuminate\Http\Request;

class PerjalananController extends Controller
{
    public function getPerjalanan()
    {
        $data = Perjalanan::where('status', '!=', '0')->with(['material', 'kendaraan', 'driver', 'suplier'])->get();

        if($data->isEmpty()){
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'Data perjalanan tidak ditemukan',
                'data'      => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Data perjalanan berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    public function storePerjalanan(Request $request)
    {
        $request->validate([
            'tanggal'       => 'required|date',
            'material_id'   => 'required|exists:material,id',
            'kode'          => 'required|string',
            'kendaraan_id'  => 'required|exists:kendaraan,id',
            'driver_id'     => 'required|exists:driver,id',
            'suplier_id'    => 'required|exists:suplier,id',
            'volume'        => 'required',
            'berat_total'   => 'required',
            'berat_kendaraan' => 'required',
            'berat_muatan'  => 'required',
        ]);

        $perjalanan = Perjalanan::create([
            'tanggal'       => $request->tanggal,
            'material_id'   => $request->material_id,
            'kode'          => strtoupper($request->kode),
            'kendaraan_id'  => $request->kendaraan_id,
            'driver_id'     => $request->driver_id,
            'suplier_id'    => $request->suplier_id,
            'volume'        => $request->volume,
            'berat_total'   => $request->berat_total,
            'berat_kendaraan' => $request->berat_kendaraan,
            'berat_muatan'  => $request->berat_muatan,
        ]);

        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => 'Perjalanan created successfully.',
            'data' => $perjalanan
        ], 201);
    }

    public function editPerjalanan($id)
    {
        $perjalanan = Perjalanan::with(['material', 'kendaraan', 'driver', 'suplier'])->find($id);

        if (!$perjalanan) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Perjalanan not found.',
                'data' => null
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Perjalanan retrieved successfully.',
            'data' => $perjalanan
        ], 200);
    }

    public function updatePerjalanan(Request $request, $id)
    {
        $perjalanan = Perjalanan::find($id);

        if (!$perjalanan) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Perjalanan not found.',
                'data' => null
            ]);
        }

        $request->validate([
            'editTanggal'       => 'required|date',
            'editMaterial_id'   => 'required|exists:material,id',
            'editKode'          => 'required|string',
            'editKendaraan_id'  => 'required|exists:kendaraan,id',
            'editDriver_id'     => 'required|exists:driver,id',
            'editSuplier_id'    => 'required|exists:suplier,id',
            'editVolume'        => 'required',
            'editBerat_total'   => 'required',
            'editBerat_kendaraan' => 'required',
            'editBerat_muatan'  => 'required',
        ]);

        $perjalanan->update([
            'tanggal'       => $request->editTanggal,
            'material_id'   => $request->editMaterial_id,
            'kode'          => strtoupper($request->editKode),
            'kendaraan_id'  => $request->editKendaraan_id,
            'driver_id'     => $request->editDriver_id,
            'suplier_id'    => $request->editSuplier_id,
            'volume'        => $request->editVolume,
            'berat_total'   => $request->editBerat_total,
            'berat_kendaraan' => $request->editBerat_kendaraan,
            'berat_muatan'  => $request->editBerat_muatan,
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Perjalanan updated successfully.',
            'data' => $perjalanan
        ], 200);
    }

    public function deletePerjalanan($id)
    {
        $perjalanan = Perjalanan::find($id);

        if (!$perjalanan) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Perjalanan not found.',
                'data' => null
            ]);
        }

        $perjalanan->status = 0;
        $perjalanan->save();

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Perjalanan deleted successfully.',
            'data' => null
        ], 200);
    }
}
