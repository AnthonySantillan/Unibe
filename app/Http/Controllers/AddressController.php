<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::get();
        return response()->json($address,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = new Address();
        $address->parish = $request->parish;
        $address->sector = $request->sector;
        $address->neighborhood = $request->neighborhood;
        $address->main_street = $request->main_street;
        $address->back_street = $request->back_street;
        $address->house_number = $request->house_number;
        $address->reference = $request->reference;
        $address->save();

        return response()->json(
            [
                'data' => $address,
                'msg' => [
                    'summary' => 'Creacion exitosamente',
                    'detail' => 'Dato creado con exito',
                    'code' => '201'
                ]

            ],201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);
        return response()->json(
            [
                'data' => $address,
                'msg' => [
                    'summary' => 'consulta correcta',
                    'detail' => 'la consulta del usuario funciono correctamente',
                    'code' => '200'
                ]

            ],200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $address->parish = $request->parish;
        $address->sector = $request->sector;
        $address->neighborhood = $request->neighborhood;
        $address->main_street = $request->main_street;
        $address->back_street = $request->back_street;
        $address->house_number = $request->house_number;
        $address->reference = $request->reference;
        $address->save();

        return response()->json(
            [
                'data' => $address,
                'msg' => [
                    'summary' => 'actualizacion correcta',
                    'detail' => 'los datos se han actualizado',
                    'code' => '201'
                ]

            ],201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();
        return response()->json(
            [
                'data' => $address,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
