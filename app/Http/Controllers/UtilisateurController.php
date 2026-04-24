<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Important for passwords!

class UtilisateurController extends Controller
{
    public function index()
    {
        return response()->json(Utilisateur::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_user'     => 'required|string|max:15|unique:utilisateur,code_user',
            'nom_user'      => 'required|string|max:255',
            'prenom_user'   => 'required|string|max:255',
            'login_user'    => 'required|string|unique:utilisateur,login_user',
            'password_user' => 'required|string|min:6',
            'tel_user'      => 'required|string',
            'sex_user'      => 'required|in:M,F', // Matches your enum
            'role_user'     => 'nullable|in:admin,technicien,client',
            'etat_user'     => 'nullable|in:actif,inactif,bloquer'
        ]);

        // IMPORTANT: Hash the password before saving!
        $validated['password_user'] = Hash::make($request->password_user);

        $utilisateur = Utilisateur::create($validated);
        return response()->json($utilisateur, 201);
    }

    public function show($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        return response()->json($utilisateur, 200);
    }

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $validated = $request->validate([
            'nom_user'      => 'sometimes|required|string',
            'tel_user'      => 'sometimes|required|string',
            'etat_user'     => 'sometimes|required|in:actif,inactif,bloquer'
        ]);

        // Only hash password if it is being changed
        if ($request->has('password_user')) {
            $validated['password_user'] = Hash::make($request->password_user);
        }

        $utilisateur->update($validated);
        return response()->json($utilisateur, 200);
    }

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();
        return response()->json(['message' => 'Utilisateur supprimé'], 200);
    }
}
