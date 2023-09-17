<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function show(Vehicle $vehicle)
    {
        return $vehicle;
    }

    public function index()
    {
        return Vehicle::all();
    }

    public function create(Request $request)
    {
        $plate = $request->input('plate');

        $vehicle = Vehicle::where('plate', $plate)->first();

        if($vehicle){
            return response()->json([
                'error' => 'A vehicle with plate number ' .$plate .' already exists' 
            ], 409);
        }

        $vehicle = Vehicle::create([
            'plate' => $plate,
            'type' => $request->input('type')
        ]);

        return $vehicle;
    }
}
