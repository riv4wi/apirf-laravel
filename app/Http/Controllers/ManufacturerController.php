<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* Methods create() and edit() are not include because they are call
to the forms to process those requests */

class ManufacturerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Manufacturer::all()], 200);
        // @todo Porque no me funciona esto?
        // $manufacturers = DB::select("SELECT * FROM manufacturers);
        // return response()->json(['data' => $manufacturers], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get('name') || !$request->get('website'))
            return response()->json(['msg' => 'Data not completed'], 422);
        else {
            $manufacturer = Manufacturer::create($request->all());
            return response()->json(['data' => $manufacturer, 'msg' => 'Manufacturer created'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        if ($manufacturer)
            return response()->json(['data' => $manufacturer], 200);
        else
            return response()->json(['msg' => 'Manufacturer ' . $id . ' not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $method = $request->method();
        $manufacturer = Manufacturer::find($id);
        if (!$manufacturer) {
            return response()->json(['msg' => 'Manufacturer ' . $id . ' not found'], 404);
        }

        $name = $request->get('name');
        $website = $request->get('website');

        /* Method PATCH */
        if ($method === 'PATCH') {
            /* Update name */
            if ($name != null && $name != '') {
                $manufacturer->name = $name;
            }

            /* Update website */
            if ($website != null && $website != '') {
                $manufacturer->website = $website;
            }

            $manufacturer->save();
            return response()->json(['msg' => 'Manufacturer \'s record ' . $id . ' edit with PATCH'], 200);
        }

        /* Method PUT */
        if (!$name || !$website) {
            return response()->json(['msg' => 'Data not completed'], 422);
        } else {
            $manufacturer->name = $name;
            $manufacturer->website = $website;
            $manufacturer->save();
            return response()->json(['msg' => 'Manufacturer \'s record ' . $id . ' edit with PUT'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json(['msg' => 'Manufacturer ' . $id . ' not found'], 404);
        }

        // @todo It is not working in this way
        // $manufacturer = Manufacturer::find($manufacturer_id);
        // $vehicles = $manufacturer->vehicles;

        $vehicles = DB::select("SELECT id FROM vehicles where manufacturer_id = '".$id."'");
        if (sizeof($vehicles) > 0) {
            return response()->json(['msg' => 'The manufacturer can not be eliminated because it has associated vehicles.
             Eliminate the vehicles first'], 200);
        }
        $manufacturer->delete();
        return response()->json(['msg' => 'Manufacturer ' . $id . ' eliminated'], 200);
    }
}
