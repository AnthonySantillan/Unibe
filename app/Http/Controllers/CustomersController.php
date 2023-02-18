<?php

namespace App\Http\Controllers;

use App\Http\Resources\Customers\CustomerCollection;
use App\Http\Resources\Customers\CustomerResource;
use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CustomerCollection(Customers::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customers = new Customers();
        $customers->user_id = $request->user_id;
        $customers->identification_card = $request->identification_card;
        $customers->name = $request->name;
        $customers->last_name = $request->last_name;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        $customers->role = $request->role;
        $customers->state = $request->state;
        $customers->save();

        return response()->json(
            [
                'data' => $customers,
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
        $customers = Customers::find($id);
        return (new CustomerResource($customers))
        ->additional([
            'msg' => [
                'summary' => 'consulta exitosa',
                'detail' => '',
                'code' => '200'
            ]
        ]);
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
        $customers = Customers::find($id);
        $customers->user_id = $request->user_id;
        $customers->identification_card = $request->identification_card;
        $customers->name = $request->name;
        $customers->last_name = $request->last_name;
        $customers->email = $request->email;
        $customers->phone = $request->phone;
        $customers->role = $request->role;
        $customers->state = $request->state;
        $customers->save();

        return response()->json(
            [
                'data' => $customers,
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
        $customers = Customers::find($id);
        $customers->delete();
        return response()->json(
            [
                'data' => $customers,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
