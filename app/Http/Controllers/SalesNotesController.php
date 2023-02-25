<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesNotes\SalesNotesCollection;
use App\Http\Resources\SalesNotes\SalesNotesResource;
use App\Models\SalesNotesProducts;
use Illuminate\Http\Request;
use App\Models\SalesNotes;
use Illuminate\Support\Facades\DB;

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

        if(is_array($request->details))
        {
            foreach($request->details as $product)
            {
                $salesNotesProduct = new SalesNotesProducts();
                $salesNotesProduct->product_id = $product['product_id'];
                $salesNotesProduct->sales_notes_id = $salesNotes->_id;
                $salesNotesProduct->amount = $product['amount'];
                $salesNotesProduct->description = $product['description'];
                $salesNotesProduct->importe = $product['importe'];
                $salesNotesProduct->discount = $product['discount'];
                $salesNotesProduct->unit_value = $product['unit_value'];
                // $salesNotesProduct->iva = $product['iva'];
                $salesNotesProduct->save();
            }
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
        return (new SalesNotesResource($salesNotes));
    }
    public function showDetail($idDetail)
    {
        $detail = DB::table('sales_notes')
            ->join('sales_notes_products', 'sales_notes._id', '=', 'sales_notes_products.sales_notes_id')
            ->select('sales_notes_products.*')
            ->where('sales_notes_products.sales_notes_id','=' , $idDetail)
            ->get();
        return response()->json($detail, 200);
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

        if(is_array($request->details))
        {
            foreach($request->details as $product)
            {
                $salesNotesProduct = SalesNotesProducts::find($product['_id']);
                $salesNotesProduct->product_id = $product['product_id'];
                $salesNotesProduct->sales_notes_id = $salesNotes->_id;
                $salesNotesProduct->amount = $product['amount'];
                $salesNotesProduct->description = $product['description'];
                $salesNotesProduct->importe = $product['importe'];
                $salesNotesProduct->discount = $product['discount'];
                $salesNotesProduct->unit_value = $product['unit_value'];
                // $salesNotesProduct->iva = $product['iva'];
                $salesNotesProduct->save();
            }
        }
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
        $salesNotes->salesNotesProducts()->delete();
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
