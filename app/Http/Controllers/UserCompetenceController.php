<?php

namespace App\Http\Controllers;

use App\Models\UserCompetence;
use Illuminate\Http\Request;

class UserCompetenceController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'code_user' => 'required|exists:utilisateur,code_user',
            'code_comp' => 'required|exists:competences,code_comp',
        ]);

        $link = UserCompetence::create($validated);
        return response()->json($link, 201);
    }

    // Supprimer une compétence d'un utilisateur
    public function destroy($code_user, $code_comp) {
        UserCompetence::where('code_user', $code_user)
            ->where('code_comp', $code_comp)
            ->delete();
        return response()->json(['message' => 'Lien supprimé'], 200);
    }
}
