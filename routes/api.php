<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProfileController;

Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('register', [AuthController::class, 'register']);
  Route::post('login', [AuthController::class, 'login']);
  Route::group([
    'middleware' => 'auth:api'
  ], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('list-user', [AuthController::class, 'listUser']);
    Route::post('update-users/{id}', [AuthController::class, 'resetPassword']);
    Route::post('update-pw/{id}', [AuthController::class, 'updatePw']);
    Route::delete('delete-user/{id}', [AuthController::class, 'deleteUser']);
    Route::post('delete-users', [AuthController::class, 'deleteUsers']);

    Route::post('ganti-password', [AuthController::class, 'ubahPassword']);

    Route::get('active-token/{id}', [AuthController::class, 'getActiveToken']);
  });
});


Route::group([
  'prefix' => 'profile'
], function () {
  // Route::group([
  //     'middleware' => ['auth:api', 'signature']
  // ], function () {


  // --- Services Routes ---
  Route::get('/services', [ProfileController::class, 'servicesIndex']);
  Route::post('/services', [ProfileController::class, 'servicesStore']);
  Route::get('/services/{id}', [ProfileController::class, 'servicesShow']);
  Route::put('/services/{id}', [ProfileController::class, 'servicesUpdate']);
  Route::delete('/services/{id}', [ProfileController::class, 'servicesDestroy']);

  // --- Company Values Routes ---
  Route::get('/values', [ProfileController::class, 'valuesIndex']);
  Route::post('/values', [ProfileController::class, 'valuesStore']);
  Route::get('/values/{id}', [ProfileController::class, 'valuesShow']);
  Route::put('/values/{id}', [ProfileController::class, 'valuesUpdate']);
  Route::delete('/values/{id}', [ProfileController::class, 'valuesDestroy']);

  // --- Inspectors Routes ---
  Route::get('/inspectors', [ProfileController::class, 'inspectorsIndex']);
  Route::post('/inspectors', [ProfileController::class, 'inspectorsStore']);
  Route::get('/inspectors/{id}', [ProfileController::class, 'inspectorsShow']);
  Route::put('/inspectors/{id}', [ProfileController::class, 'inspectorsUpdate']);
  Route::delete('/inspectors/{id}', [ProfileController::class, 'inspectorsDestroy']);

  // --- Partners Routes ---
  Route::get('/partners', [ProfileController::class, 'partnersIndex']);
  Route::post('/partners', [ProfileController::class, 'partnersStore']);
  Route::get('/partners/{id}', [ProfileController::class, 'partnersShow']);
  Route::put('/partners/{id}', [ProfileController::class, 'partnersUpdate']);
  Route::delete('/partners/{id}', [ProfileController::class, 'partnersDestroy']);


  // --- Galleries Routes ---
  Route::get('/galleries', [ProfileController::class, 'galleriesIndex']);
  Route::post('/galleries', [ProfileController::class, 'galleriesStore']);
  Route::get('/galleries/{id}', [ProfileController::class, 'galleriesShow']);
  Route::put('/galleries/{id}', [ProfileController::class, 'galleriesUpdate']);
  Route::delete('/galleries/{id}', [ProfileController::class, 'galleriesDestroy']);


  // });
});
