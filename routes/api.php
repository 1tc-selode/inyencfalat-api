<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\IngreditentController;
/*
GET /api/meals – Listázza az összes ételt összetevőikkel együtt.
● POST /api/meals – Új étel létrehozása és hozzárendelése összetevőkhöz.
● PUT /api/meals/{id} – Étel módosítása
● GET /api/ingredients – Listázza az összes összetevőt.
● GET /api/meals/search/{ingredient} – Kilistázza azokat az ételeket, amelyek
tartalmazzák a megadott összetevőt.
*/

Route::get('/meals', [MealController::class, 'index']);
Route::post('/meals', [MealController::class, 'store']);
Route::put('/meals/{id}', [MealController::class, 'update']);
Route::get('/ingredients', [IngreditentController::class, 'index']);
Route::get('/meals/search/{ingredient}', [MealController::class, 'search']);