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
        $vehicles = DB::select("SELECT * FROM vehicles where manufacturer_id = '".$manufacturer_id."'");

        // @todo It is not working in this way
        //  $manufacturer = Manufacturer::find($manufacturer_id);
        //  $vehicles = $manufacturer->vehicles;

        if ($vehicles)
            return response()->json(['data' => $vehicles], 200);
        else
            return response()->json(['msg' => 'Manufacturer without vehicles'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($manufacturer_id)
    {
        return "Mostrando formulario para crear vehiculo del fabricante $manufacturer_id";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $manufacturer_id)
    {
        if (!$request->get('model') || !$request->get('color'))
            return response()->json(['msg' => 'Datos incompletos'], 422);
        else {
            $manufacturer = Manufacturer::find($manufacturer_id);
            if (!$manufacturer)
                return response()->json(['msg' => 'Manufacturer is not exist.'], 404);
            else {
                /*Vehicle::create($request->all());*/
                Vehicle::create(['manufacturer_id' => $manufacturer_id, 'model' => $request->get('model'), 'color' => $request->get('color')]);
                return response()->json(['mgs' => 'Vehicle of manufacturer ' . $request->get('manufacturer_id') . ' it was created'], 201);
            }
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
        $vehicle = Vehicle::where('manufacturer_id', '=', $manufacturer_id)
            ->where('id', '=', $vehicle_id)
            ->limit(1)
            ->get();

        if ($vehicle)
            return response()->json(['data' => $vehicle], 200);
        else
            return response()->json(['msg' => 'Manufacturer without vehicles'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($manufacturer_id, $vehicle_id)
    {
        return "Editando el vehiculo $vehicle_id del fabricante $manufacturer_id";
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
        if (!$manufacturer) {
            return response()->json(['msg' => 'Manufacturer ' . $manufacturer_id . ' not found'], 404);
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (!$vehicle) {
            return response()->json(['msg' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' .
                $manufacturer_id . ' not found'], 404);
        }

        $model = $request->get('model');
        $color = $request->get('color');
        $method = $request->method();

        /* Method PATCH */
        if ($method === 'PATCH') {

            $edited = false;

            /* Update model */
            if ($model != null && $model != '') {
                $vehicle->model = $model;
                $edited = true;
            }

            /* Update color */
            if ($color != null && $color != '') {
                $vehicle->color = $color;
                $edited = true;
            }

            if ($edited) {
                $vehicle->save();
                return response()->json(['msg' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer_id .
                    ' edited with PATCH'], 200);
            }
            else{
                return response()->json(['msg' =>'There wasn\'t changes']);
            }
        }

        /* Method PUT */
        if (!$model || !$color) {
            return response()->json(['msg' => 'Data not completed'], 422);
        } else {
            $vehicle->model = $model;
            $vehicle->color = $color;
            $vehicle->save();
            return response()->json(['msg' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer_id .
                ' edited with PUT'], 200);
        }
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
        if (!$manufacturer) {
            return response()->json(['msg' => 'Manufacturer ' . $manufacturer_id . ' not found'], 404);
        }

        $vehicle = Vehicle::find($vehicle_id);
        if (!$vehicle) {
            return response()->json(['msg' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' .
                $manufacturer_id . ' not found'], 404);
        }

        /* Method DELETE */
        $vehicle->delete();
        return response()->json(['msg' => 'Vehicle ' . $vehicle_id . ' of manufacturer ' . $manufacturer_id .
            ' eliminated'], 200);
    }
}
