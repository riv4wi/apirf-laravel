<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Lang;
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
     * @access public
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response()->json(['data' =>  DB::select("SELECT * FROM manufacturers")], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @access public
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array('name' => 'required', 'website' => 'required');
        
        $validatedData = $request->validate($rules);

        $manufacturer = Manufacturer::create($request->all());

        return response()->json(['data' => $manufacturer, 'success' => array('message' => Lang::get('general.manufacturer_created'))], 201);

    // @todo Algo sucede con la traduccion arabe que en este metodo no aparecen los caracteres correctamente en el mensaje de success
    }

    /**
     * Display the specified resource.
     *
     * @access public
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);
        if ($manufacturer)
            return response()->json(['data' => $manufacturer], 200);
        else
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $id]))], 404);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @access public
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Responsed
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $manufacturer = Manufacturer::find($id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $id]))], 404);   
        }

        $manufacturer->fill($data);
        $manufacturer->save();
        return response()->json(['success' => array('message' => Lang::get('general.manufacturer_edited',['ID' => $id]))], 200);   
        // @todo What happens if all input fields are empty?... 
        // Is fine that? Is there some better validation?
    }

    /**
     * Remove the specified resource from storage.
     *
     * @access public
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        if (is_null($manufacturer)){
            return response()->json(['error'=>array('message' => Lang::get('general.manufacturer_not_found',['ID' => $id]))], 404);   
        }

        $vehicles = DB::select("SELECT id FROM vehicles WHERE manufacturer_id = '".$id."'");
        if (sizeof($vehicles) > 0) {
            return response()->json(['error' => array('message' => Lang::get('general.eliminate_vehicles_first'))], 201);
        }

        Manufacturer::destroy($id);
        
        return response()->json(['success' => array('message' => Lang::get('general.manufacturer_deleted',['name' => $manufacturer]))], 200); 
    }
    
}
