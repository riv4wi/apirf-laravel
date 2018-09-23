<?php

namespace App\Http\Controllers;

use App\Identifier;
use Illuminate\Http\Request;

class IdentifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Identifier::paginate($request->get('perPage'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Identifier::created($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Identifier  $identifier
     * @return \Illuminate\Http\Response
     */
    public function show(Identifier $identifier)
    {
        return $identifier->load("vehicle");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Identifier  $identifier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Identifier $identifier)
    {
        $identifier->update($request->all());
        return $identifier;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Identifier  $identifier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Identifier $identifier)
    {
        return $identifier->delete();
    }
}
