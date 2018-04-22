<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Vehicle;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function index($manufacturer_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $manufacturer_id]))], 404); 
        }

        $vehicles = DB::select("SELECT * FROM vehicles where manufacturer_id = '" . $manufacturer_id . "'");

        if ($vehicles)
            return response()->json(['data' => $vehicles], 200);
        else
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_without_vehicles'))], 404); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @access public
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $manufacturer_id)
    {
        $rules = array('model' => 'required', 'color' => 'required');
        
        $validatedData = $request->validate($rules);

        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer))
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $manufacturer_id]))], 404);
        else {
            Vehicle::create(['manufacturer_id' => $manufacturer_id,
                              'model'=>$request->model,
                              'color'=>$request->color]);
            return response()->json(['data' => $manufacturer, 'success' => array('message' => Lang::get('general.vehicle_created',['name' => $manufacturer->name]))], 201); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @access public
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $manufacturer_id]))], 404);
        }

        $vehicle = DB::select("SELECT manufacturer_id, model, color FROM vehicles WHERE manufacturer_id = '".$manufacturer_id."' AND id = '".$vehicle_id."'");
        if (sizeof($vehicle) > 0) {
            return response()->json(['data' => $vehicle], 200);
        }
        return response()->json(['error'=>array('message' => Lang::get('general.vehicle_not_found',['ID' => $vehicle_id, 'MANUFACTURER'=>$manufacturer->name]))], 404); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @access public
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $manufacturer_id]))], 404);
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json(['error'=>array('message' => Lang::get('general.vehicle_not_found',['ID' => $vehicle_id, 'MANUFACTURER'=>$manufacturer->name]))], 404); 
        }

        $data = $request->all();
        $vehicle->fill($data);
        $vehicle->save();
        return response()->json(['success' => array('message' => Lang::get('general.vehicle_edited',['ID' => $vehicle_id, 'MANUFACTURER'=>$manufacturer->name]))], 200); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @access public
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($manufacturer_id, $vehicle_id)
    {
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $manufacturer_id]))], 404); 
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json(['error'=>array('message' => Lang::get('general.vehicle_not_found',['ID' => $vehicle_id, 'MANUFACTURER'=>$manufacturer->name]))], 404); 
        }

        Vehicle::destroy($vehicle_id);
        return response()->json(['success' => array('message' => Lang::get('general.vehicle_deleted',['MODEL'=>$vehicle->model, 'MANUFACTURER'=>$manufacturer->name]))], 200); 
    }
}
