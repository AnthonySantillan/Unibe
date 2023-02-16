<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        return response()->json($user, 200);
    }

    public function auth(Request $request)
    {
        $data = json_decode($request->getContent());
        $user = User::where('username', $data->username)->first();
        $response = [];
        $status = 200;
        if ($user) {
            if ($data->password === $user->password) {
                $token = $user->createToken('TokenUser');
                $response["name"] = $user->username;
                $response["token"] = $token->plainTextToken;
            } else{
                $response["message"] = 'El usuario y/o contraseña son incorrectos';
                $status=401;
            }
        } else {
            $response["message"] = 'El usuario y/o contraseña son incorrectos';
            $status=404;
        }
        return response()->json($response)->setStatusCode($status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->save();

        return response()->json(
            [
                'data' => $user,
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
        $user = User::find($id);
        return response()->json($user,200);
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
        $user = User::find($id);
        $user->username = $request->username;
        $user->password = $request->password;
        $user->state = $request->state;
        $user->save();

        return response()->json(
            [
                'data' => $user,
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
        $user = User::find($id);
        $user->delete();
        return response()->json(
            [
                'data' => $user,
                'msg' => [
                    'summary' => 'eliminacion correcta',
                    'detail' => 'dato eliminado',
                    'code' => '201'
                ]

            ],201
        );
    }
}
