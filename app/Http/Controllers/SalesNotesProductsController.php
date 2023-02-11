<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesNotesProducts;
class SalesNotesProductsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesNotesProducts = SalesNotesProducts::get();
        return response()->json(
            [
                'data' => $salesNotesProducts,
                'msg' => [
                    'summary' => 'consulta correcta',
                    'detail' => 'la consulta se realizo exitosamente',
                    'code' => '200'
                ]

            ],200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salesNotesProducts = new SalesNotesProducts();
        $salesNotesProducts->user_id = $request->user_id;
        $salesNotesProducts->sales_notes_product_id = $request->sales_notes_product_id;
        $salesNotesProducts->amount = $request->amount;
        $salesNotesProducts->unit_value = $request->unit_value;
        $salesNotesProducts->iva = $request->iva;
        $salesNotesProducts->total = $request->total;
        $salesNotesProducts->save();

        return response()->json(
            [
                'data' => $salesNotesProducts,
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
        $salesNotesProducts = SalesNotesProducts::find($id);
        return response()->json(
            [
                'data' => $salesNotesProducts,
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
        $salesNotesProducts = SalesNotesProducts::find($id);
        $salesNotesProducts->user_id = $request->user_id;
        $salesNotesProducts->sales_notes_product_id = $request->sales_notes_product_id;
        $salesNotesProducts->amount = $request->amount;
        $salesNotesProducts->unit_value = $request->unit_value;
        $salesNotesProducts->iva = $request->iva;
        $salesNotesProducts->total = $request->total;
        $salesNotesProducts->save();

        return response()->json(
            [
                'data' => $salesNotesProducts,
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
        $salesNotesProducts = SalesNotesProducts::find($id);
        $salesNotesProducts->delete();
        return response()->json(
            [
                'data' => $salesNotesProducts,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
