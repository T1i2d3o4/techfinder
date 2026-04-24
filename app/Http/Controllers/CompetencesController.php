<?php

namespace App\Http\Controllers;

use App\Models\Competences;
use Illuminate\Http\Request;

class CompetencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $competences = Competences::all();
        return response()->json($competences, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $validate=  $request->validate([
            'label_compo'=> 'required|string|max:255',
            'description_comp' => 'nullable|string'
        ]);
        try{
        $competences = Competences::create($validate);
        return response()->json($competences,201);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Failed to create competence', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $code_comp){
        try{
            $competences = Competences::findOrFail($code_comp);
            return response()->json($competences, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Competence not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $code_comp)
    {
        //

        $competence = Competences::findOrFail($code_comp);

        $validate = $request->validate([
            'label_compo' => 'required|string|max:255',
            'description_comp' => 'nullable|string'
        ]);

        try{
            $competence->update($validate);
            return response()->json($competence, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Competence not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $code_comp)
    {
        try{
            $competence = Competences::findOrFail($code_comp);
            $competence->delete();
            return response()->json(['message' => 'Competence deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Competence not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }


    public function search($keyword)
{
    $competences = Competences::where('label_compo', 'like', '%' . $keyword . '%')
        ->orWhere('description_comp', 'like', '%' . $keyword . '%')
        ->get();

    return response()->json($competences, 200);
}

}
