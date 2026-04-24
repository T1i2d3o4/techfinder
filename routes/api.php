<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetencesController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserCompetenceController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UtilisateurController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Utilisateur connecté
    Route::get('/me', fn(Request $r) => response()->json($r->user()));

    // Compétences — search AVANT apiResource sinon conflit avec show()

});

    Route::get('competences/search/{keyword}', [CompetencesController::class, 'search']);
    Route::apiResource('competences', CompetencesController::class);

    // Utilisateurs (store retiré car c'est le register public)
    Route::apiResource('utilisateurs', UtilisateurController::class)->except(['store']);

    // Interventions
    Route::apiResource('interventions', InterventionController::class);

    // Liens User-Compétence
    Route::post('user-competences', [UserCompetenceController::class, 'store']);
    Route::delete('user-competences/{code_user}/{code_comp}', [UserCompetenceController::class, 'destroy']);
