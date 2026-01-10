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
}
