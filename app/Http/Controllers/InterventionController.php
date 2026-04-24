<?php

namespace App\Http\Controllers;

use App\Models\Intervation;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index() {
        return response()->json(Intervation::with(['client', 'technicien', 'competence'])->get(), 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'code_user_client' => 'required|exists:utilisateur,code_user',
            'code_user_tech'   => 'required|exists:utilisateur,code_user',
            'code_comp'        => 'required|exists:competences,code_comp',
            'commentaire_int'  => 'nullable|string',
            'note_int'         => 'integer|min:0|max:5'
        ]);

        $intervention = Intervation::create($validated);
        return response()->json($intervention, 201);
    }

    public function show($id) {
        return response()->json(Intervation::findOrFail($id), 200);
    }
}
