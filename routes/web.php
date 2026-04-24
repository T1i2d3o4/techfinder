<?php

use App\Http\Controllers\web\CompetencesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/web/competences',[CompetencesController::class, 'index']);
Route::post('/web/competences', [CompetencesController::class, 'store']);
Route::get('/web/competences/{id}/edit', [CompetencesController::class, 'edit']);
Route::put('/web/competences/{id}', [CompetencesController::class, 'update']);
Route::delete('/web/competences/{id}', [CompetencesController::class, 'destroy']);



use App\Http\Controllers\web\UtilisateurWebController;

Route::get('/web/utilisateurs', [UtilisateurWebController::class, 'index']);
Route::post('/web/utilisateurs', [UtilisateurWebController::class, 'store']);
Route::put('/web/utilisateurs/{id}', [UtilisateurWebController::class, 'update']);
Route::delete('/web/utilisateurs/{id}', [UtilisateurWebController::class, 'destroy']);
