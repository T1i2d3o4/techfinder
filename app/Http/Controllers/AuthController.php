<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'login_user' => 'required',
            'password' => 'required',
        ]);

        $user = Utilisateur::where('login_user', $request->login_user)->first();

        if (!$user || !Hash::check($request->password, $user->password_user)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        // Création du token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnecté']);
    }
}
