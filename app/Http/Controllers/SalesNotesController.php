<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesNotes;
class SalesNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salesNotes = SalesNotes::get();
        return response()->json($salesNotes,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salesNotes = new SalesNotes();
        $salesNotes->product_id = $request->product_id;
        $salesNotes->code = $request->code;
        $salesNotes->invoice_number = $request->invoice_number;
        $salesNotes->subtotal = $request->subtotal;
        $salesNotes->iva = $request->iva;
        $salesNotes->total = $request->total;
        $salesNotes->state = $request->state;
        $salesNotes->save();

        return response()->json(
            [
                'data' => $salesNotes,
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
        $salesNotes = SalesNotes::find($id);
        return response()->json($salesNotes, 200);
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
        $salesNotes = SalesNotes::find($id);
        $salesNotes->product_id = $request->product_id;
        $salesNotes->code = $request->code;
        $salesNotes->invoice_number = $request->invoice_number;
        $salesNotes->subtotal = $request->subtotal;
        $salesNotes->iva = $request->iva;
        $salesNotes->total = $request->total;
        $salesNotes->state = $request->state;
        $salesNotes->save();

        return response()->json(
            [
                'data' => $salesNotes,
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
        $salesNotes = SalesNotes::find($id);
        $salesNotes->delete();
        return response()->json(
            [
                'data' => $salesNotes,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
