<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
          $request->validate([
             'name' =>'required',
             'email' =>'required|email',
             'password' =>'required'
          ]);

          $user = new User();
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);
          $user->passwordmobil = encrypt($request->password);
          $user->codigo = "00001";
          $user->especialidad = "00001";
          $user->profesional = "00010";
          $user->tipodeusuario = 1;
          $user->vendedor = "001";
          $user->save();

          return response()->json([
            'status' => '200',
            'msg' => 'Creación de Usuario Exitosa'

          ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' =>'required',
            'password' =>'required'
         ]);

         $usuario = User::where('email','=',$request->email)->first();


         $usuario = User::where('email','=',$request->email)->first();

        if (isset($usuario->id))
         {


            if (Hash::check($request->password,$usuario->password))
               {
                // Creamos TOKEN

                $token = $usuario->createToken("auth_token")->plainTextToken;
                return response()->json(
                 [
                     'status' => '1',
                     'msg' => 'Usuario logueado Exitosamente',
                     'codusuario' => $usuario->codigo,
                     'access_token' =>$token,
                     'data' => $usuario,
                     'request' => $request,
                 ],200);
               }
            else
               {
                return response()->json(
                    [
                     'status' => '0',
                     'msg' => 'Contraseña Inválida',
                     'Password'=>$usuario->password
                    ],404);
               }
         }
         else
         {
           return response()->json(
             [
              'status' => '500',
              'msg' => 'Usuario Inválido'
             ],404);
         }

    }

    public function userProfile()
    {

        return response()->json(
            [
             'status' => '1',
             'msg' => 'Solicitud Exitosa del Usuario',
             'data' => Auth()->user(),
            ]);
    }
}
