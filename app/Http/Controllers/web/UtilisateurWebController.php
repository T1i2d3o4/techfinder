<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurWebController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::paginate(10);
        return view('utilisateur', compact('utilisateurs'));
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'nom_user'    => 'required',
        'prenom_user' => 'required',
        'login_user'  => 'required|unique:utilisateur,login_user',
        'tel_user'    => 'required',
        'sex_user'    => 'required|in:M,F',
    ]);

    // Correction : On compte le nombre total pour générer le matricule
    // Ou on trie par created_at si la colonne existe
    $count = Utilisateur::count();
    $numero = $count + 1;

    $codeGenere = 'USR-' . date('Y') . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

    $validated['code_user'] = $codeGenere;
    $validated['password_user'] = Hash::make('password123');
    $validated['role_user'] = 'technicien';
    $validated['etat_user'] = 'actif';

    Utilisateur::create($validated);

    return redirect()->back()->with('success', "Utilisateur créé : $codeGenere");
}

    public function update(Request $request, $id)
    {
        $utilisateur = Utilisateur::findOrFail($id);

        $validated = $request->validate([
            'nom_user'  => 'required',
            'prenom_user' => 'required',
            'tel_user'  => 'required',
            'etat_user' => 'required|in:actif,inactif,bloquer',
            'role_user' => 'required'
        ]);

        $utilisateur->update($validated);

        return redirect()->back()->with('success', 'Utilisateur mis à jour !');
    }

    public function destroy($id)
    {
        Utilisateur::findOrFail($id)->delete();
        return redirect()->back()->with('error', 'Utilisateur supprimé.');
    }
}
