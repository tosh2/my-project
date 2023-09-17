<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use PDF;
use DB;

use App\Models\Record;
use App\Models\Vehicle;


class RecordController extends Controller
{
    public function index()
    {
        return Record::with('vehicle')->get();
    }

    public function create(Request $request)
    {
        $plate = $request->input('plate');
        $vehicle = Vehicle::where('plate', $plate)->first();
        if(!$vehicle) 
        {
            return response()->json([
                'error' => 'Vehicle with plate number ' . $plate . ' does not exist'
            ], 404);    
        }

        $record = Record::where([
            ['vehicle_id', $vehicle->id],
            ['leave_at', null]
        ])->first();

        if($record)
        {
            return response()->json([
                'error' => 'Vehicle with plate number ' . $plate . ' has not leave the parking lot'
            ], 409); 
        }

        $record = Record::create([
            'vehicle_id' => $vehicle->id
        ]);

        return $record;
    }

    public function checkOut(Request $request)
    {
        $plate = $request->input('plate');
        $vehicle = Vehicle::where('plate', $plate)->first();
        if(!$vehicle) 
        {
            return response()->json([
                'error' => 'Vehicle with plate number ' . $plate . ' does not exist'
            ], 404);    
        }

        $record = Record::where([
            ['vehicle_id', $vehicle->id],
            ['leave_at', null]
        ])->first();

        if(!$record)
        {
            return response()->json([
                'error' => 'Vehicle with plate number ' . $plate . ' is not in the parking lot'
            ], 409); 
        }

        $record->total = $vehicle->price_per_minute * Carbon::now()->diffInMinutes(Carbon::create($record->created_at));
        $record->leave_at = Carbon::now()->toDateTimeString();

        $record->save();

        return $record;

    }

    public function createPDF(Request $request)
    {
        $records = Record::whereHas('vehicle', function($q){
            $q->where('type', 'resident');
        })->get();

        view()->share('record',$records);
        $pdf = PDF::loadView('index', $records->toArray());
        return $pdf->download('pdf_file.pdf');
    }


}
