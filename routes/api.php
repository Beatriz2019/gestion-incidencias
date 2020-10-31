<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); 
*/
//esta ruta va a ser resuelta por el método byProject que está en LevelController
// en el namespace Admin
//vamos a obtener los niveles del proyecto que tenga el id  {id}
Route::get('/proyecto/{id}/niveles', 'Admin\LevelController@byProject');
