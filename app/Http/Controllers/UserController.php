<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function register(StoreUserPost $request)
    {
        try {
            $user = User::where(['email' => $request->email])->exists();
            if ($user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário já cadastrado'
                ]);
            }
            $request->merge(['password' => Hash::make($request->password)]);
            $user = User::create($request->except('query_string'));
            return response()->json([
                'success' => true,
                'message' => 'Usuário registrado com sucesso',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Não foi possivel cadastrar o usuário'
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('token')->accessToken;
                return response()->json(['token' => $token]);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível efetuar o login.'
            ]);
        }
    }
}
