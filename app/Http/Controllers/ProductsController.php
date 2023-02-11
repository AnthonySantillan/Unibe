<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        return response()->json(
            [
                'data' => $products,
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
        $products = new Products();
        $products->cellar_id = $request->cellar_id;
        $products->code = $request->code;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->state = $request->state;
        $products->save();

        return response()->json(
            [
                'data' => $products,
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
        $products = Products::find($id);
        return response()->json(
            [
                'data' => $products,
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
        $products = Products::find($id);
        $products->cellar_id = $request->cellar_id;
        $products->code = $request->code;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->state = $request->state;
        $products->save();

        return response()->json(
            [
                'data' => $products,
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
        $products = Products::find($id);
        $products->delete();
        return response()->json(
            [
                'data' => $products,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
