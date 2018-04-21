<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($manufacturer_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $manufacturer_id . ' not found')], 404); 
        }

        $vehicles = DB::select("SELECT * FROM vehicles where manufacturer_id = '" . $manufacturer_id . "'");

        if ($vehicles)
            return response()->json(['data' => $vehicles], 200);
        else
            return response()->json(['error'=>array('message' => 'Manufacturer without vehicles')], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $manufacturer_id)
    {
        $rules = array('model' => 'required', 'color' => 'required');
        
        $validatedData = $request->validate($rules);

        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer))
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $id . ' not found')], 404); 
        else {
            Vehicle::create($request->all());
            return response()->json(['data' => $manufacturer, 'success' => array('message' => 'Vehicle of manufacturer ' . $manufacturer->name . ' it was created')], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $manufacturer_id . ' not found')], 404); 
        }

        $vehicle = DB::select("SELECT manufacturer_id, model, color FROM vehicles WHERE manufacturer_id = '".$manufacturer_id."' AND id = '".$vehicle_id."'");
        if (sizeof($vehicle) > 0) {
            return response()->json(['data' => $vehicle], 200);
        }
        return response()->json(['error'=>array('message' => 'Vehicle not found')], 404);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $id . ' not found')], 404); 
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json(['error'=>array('message' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer->name . ' not found')], 404);  
        }

        $data = $request->all();
        $vehicle->fill($data);
        $vehicle->save();
        return response()->json(['success' => array('message' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer->name .
                ' edited')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $manufacturer_id . ' not found')], 404);    
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json(['error'=>array('message' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer->name . ' not found')], 404);  
        }

        Vehicle::destroy($vehicle_id);
        return response()->json(['success' => array('message' => 'Vehicle ' . $vehicle->model . ' of manufacturer ' . $manufacturer->name .
                ' deleted')], 200);
    }
}
