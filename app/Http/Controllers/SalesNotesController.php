<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesNotes\SalesNotesCollection;
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
        return new SalesNotesCollection(SalesNotes::all());
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
        $salesNotes->user_id = $request->user_id;
        $salesNotes->invoice_number = $request->invoice_number;
        $salesNotes->subtotal = $request->subtotal;
        $salesNotes->client_id = $request->client_id;
        $salesNotes->discount = $request->discount;
        $salesNotes->date = $request->date;
        $salesNotes->observation = $request->observation;
        $salesNotes->forma_pago = $request->forma_pago;
        $salesNotes->iva = $request->iva;
        $salesNotes->total = $request->total;
        $salesNotes->state = $request->state;
        $salesNotes->save();

        foreach($salesNotes['details'] as $salesNotesProducts)
        {
            $salesNotesProducts = new SalesNotesProducts();
            $salesNotesProducts->product_id = $request->product_id;
            $salesNotesProducts->sales_notes_id = $salesNotes->_id;
            $salesNotesProducts->amount = $request->amount;
            $salesNotesProducts->description = $request->description;
            $salesNotesProducts->importe = $request->importe;
            $salesNotesProducts->discount = $request->discount;
            $salesNotesProducts->unit_value = $request->unit_value;
            $salesNotesProducts->iva = $request->iva;
            $salesNotesProducts->save();
        }


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
        $salesNotes->user_id = $request->user_id;
        $salesNotes->sales_notes_product_id = $request->sales_notes_product_id;
        $salesNotes->invoice_number = $request->invoice_number;
        $salesNotes->subtotal = $request->subtotal;
        $salesNotes->client_id = $request->client_id;
        $salesNotes->discount = $request->discount;
        $salesNotes->date = $request->date;
        $salesNotes->observation = $request->observation;
        $salesNotes->forma_pago = $request->forma_pago;
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
