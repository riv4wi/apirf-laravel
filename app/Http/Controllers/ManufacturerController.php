<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
         return response()->json(['data' =>  DB::select("SELECT * FROM manufacturers")], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array('name' => 'required', 'website' => 'required');
        
        $validatedData = $request->validate($rules);

        $manufacturer = Manufacturer::create($request->all());

        return response()->json(['data' => $manufacturer, 'success' => array('message' => 'Manufacturer created')], 201);
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
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $id . ' not found')], 404);            

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Responsed
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $manufacturer = Manufacturer::find($id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $id . ' not found')], 404);    
        }

        $manufacturer->fill($data);
        $manufacturer->save();
        return response()->json(['success' => array('message' => 'Manufacturer \'s record ' . $id . ' edited')], 200);

        // @todo What happens if all input fields are empty?... 
        // Is fine that? Is there some better validation?
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
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => 'Manufacturer ' . $id . ' not found')], 404);    
        }

        $vehicles = DB::select("SELECT id FROM vehicles WHERE manufacturer_id = '".$id."'");
        if (sizeof($vehicles) > 0) {
            return response()->json(['message' => 'The manufacturer can not be eliminated because it has associated vehicles.
             Eliminate the vehicles first'], 200);
        }

        Manufacturer::destroy($id);
        
        return response()->json(['success' => array('message' => 'Manufacturer ' . $id . ' deleted')], 200);
    }
}
