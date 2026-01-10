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
}
