<?php

namespace App\Http\Controllers;

use App\Models\Utills;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {

                // Criação do usuário no banco de dados
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // Geração de um token JWT para o novo usuário


                // Retorno do token e informações do usuário
                return response()->json([
                    'user' => $user
                ], 201);
        }catch (\Exception $exception){
            return response()->json(Utills::returnException($exception));
        }

    }
// Método para autenticar e obter o token JWT
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 400);
            }
        }catch (\Exception $exception){
            return response()->json(Utills::returnException($exception));
        }

        return response()->json(compact('token'));
    }


}
