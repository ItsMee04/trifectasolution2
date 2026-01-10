<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function getMaterial()
    {
        $data = Material::where('status', '1')->get();

        if ($data->isEmpty()) {
            return response()->json([
                'status'    => 404,
                'success'   => false,
                'message'   => 'No active materials found.',
                'data'      => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Active materials retrieved successfully.',
            'data' => $data
        ], 200);
    }

    public function storeMaterial(Request $request)
    {
        $request->validate([
            'kode'      => 'required|string|unique:material,kode|max:50',
            'nama'      => 'required|string|max:255',
            'satuan'    => 'required|string|max:100',
            'rumus'     => 'nullable|string',
        ]);

        $material = Material::create([
            'kode'      => strtoupper($request->kode),
            'nama'      => strtoupper($request->nama),
            'satuan'    => strtoupper($request->satuan),
            'rumus'     => strtoupper($request->rumus),
        ]);

        return response()->json([
            'status' => 201,
            'success' => true,
            'message' => 'Material created successfully.',
            'data' => $material
        ], 201);
    }

    public function editMaterial($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Material not found.',
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Material retrieved successfully.',
            'data' => $material
        ], 200);
    }

    public function updateMaterial(Request $request, $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => 'Material not found.',
            ]);
        }

        $request->validate([
            'editkode'      => 'required|string|max:50|unique:material,kode,' . $id,
            'editnama'      => 'required|string|max:255',
            'editsatuan'    => 'required|string|max:100',
            'editrumus'     => 'nullable|string',
        ]);

        $material->update([
            'kode'      => strtoupper($request->editkode),
            'nama'      => strtoupper($request->editnama),
            'satuan'    => strtoupper($request->editsatuan),
            'rumus'     => strtoupper($request->editrumus),
        ]);

        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'Material updated successfully.',
            'data' => $material
        ], 200);
    }
}
