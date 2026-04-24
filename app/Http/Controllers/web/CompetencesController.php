<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Competences;
use Illuminate\Http\Request;

class CompetencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $competences_list = Competences::paginate(10);
        return view('competence', compact('competences_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        try {
            $request->validate([
                'label_compo' => 'required|max:255',
                'description_comp' => 'required',
            ]);

            Competences::create($request->all());

            // Si tout se passe bien -> Toast Vert
            return redirect()->back()->with('success', 'Compétence ajoutée avec succès !');

        } catch (\Exception $e) {
            // En cas de problème (ex: base de données) -> Toast Rouge
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // On récupère la compétence par son code_comp
        $competence = Competences::findOrFail($id);

        // On retourne une nouvelle vue dédiée à l'édition
        return view('edit_competence', compact('competence'));
    }

    public function update(Request $request, $id)
    {
        // 1. Validation
        $request->validate([
            'label_compo' => 'required|max:255',
            'description_comp' => 'required',
        ]);

        // 2. Récupération et mise à jour
        $competence = Competences::findOrFail($id);
        $competence->update([
            'label_compo' => $request->label_compo,
            'description_comp' => $request->description_comp,
        ]);

        // 3. Redirection avec un message de succès
        return redirect('/web/competences')->with('success', 'Compétence mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        $competence = Competences::find($id);

        if (!$competence) {
            // Si la compétence n'existe pas -> Toast Rouge
            return redirect()->back()->with('error', 'Impossible de trouver cette compétence.');
        }

        $competence->delete();

        // Succès -> Toast Vert
        return redirect()->back()->with('error', 'La compétence a été supprimée.');
    }
}
