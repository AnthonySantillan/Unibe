<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cellars;

class CellarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cellars = Cellars::get();
        return response()->json($cellars, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cellars = new Cellars();
        $cellars->code = $request->code;
        $cellars->name = $request->name;
        if ($request->dimension) {
            $cellars->dimension = $request->dimension;
        }
        if ($request->state) {
            $cellars->state = $request->state;
        }
        if ($request->addres_id) {
            $cellars->addres_id = $request->addres_id;
        } 
        $cellars->save();

        return response()->json(
            [
                'data' => $cellars,
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
        $cellars = Cellars::find($id);
        return response()->json($cellars, 200);
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
        $cellars = Cellars::find($id);
        $cellars->code = $request->code;
        $cellars->name = $request->name;
        if ($request->dimension) {
            $cellars->dimension = $request->dimension;
        }
        if ($request->state) {
            $cellars->state = $request->state;
        }
        if ($request->addres_id) {
            $cellars->addres_id = $request->addres_id;
        } 
        $cellars->save();

        return response()->json(
            [
                'data' => $cellars,
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
        $cellars = Cellars::find($id);
        $cellars->delete();
        return response()->json(
            [
                'data' => $cellars,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
