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

        if($data->isEmpty()){
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
}
