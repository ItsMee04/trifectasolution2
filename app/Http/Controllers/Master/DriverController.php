<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Driver;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function getDriver()
    {
        $data = Driver::where('status', '1')->get();

        if($data->isEmpty()){
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'No active drivers found.',
                'data'      => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Active drivers retrieved successfully.',
            'data' => $data
        ], 200);
    }

    public function storeDriver(Request $request)
    {
        $request->validate([
            'kode'      => 'required|string|max:255',
            'nama'      => 'required|string|max:255',
            'kontak'    => 'required|string|max:255',
            'alamat'    => 'required|string|max:500',
        ]);

        $driver = Driver::create([
            'kode' => strtoupper($request->kode),
            'nama' => strtoupper($request->nama),
            'kontak' => strtoupper($request->kontak),
            'alamat' => strtoupper($request->alamat),
        ]);

        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => 'Driver created successfully.',
            'data' => $driver
        ], 201);
    }

    public function editDriver($id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Driver not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Driver retrieved successfully.',
            'data' => $driver
        ], 200);
    }

    public function updateDriver(Request $request, $id)
    {
        $request->validate([
            'editkode'   => 'required|string|max:255',
            'editnama'   => 'required|string|max:255',
            'editkontak' => 'required|string|max:255',
            'editalamat' => 'required|string|max:500',
        ]);

        $driver = Driver::find($id);

        if (!$driver) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Driver not found.',
                'data' => null
            ], 404);
        }

        $driver->update([
            'kode' => strtoupper($request->editkode),
            'nama' => strtoupper($request->editnama),
            'kontak' => strtoupper($request->editkontak),
            'alamat' => strtoupper($request->editalamat),
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Driver updated successfully.',
            'data' => $driver
        ], 200);
    }

    public function deleteDriver($id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Driver not found.',
                'data' => null
            ], 404);
        }

        $driver->update(['status' => '0']);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Driver deleted successfully.',
            'data' => null
        ], 200);
    }
}
