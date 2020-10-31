<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reportar', 'HomeController@getReport');
//Para reportar una nueva incidencia obtenemos la ruta por post
Route::post('/reportar', 'HomeController@postReport');


/*Route::get('/reportar', function () {
    return view('report');
});
*/
/*
Route::get('/reportar', 'HomeController@report');
Route::get('/usuarios', 'Controller@');
Route::get('/proyectos', 'Controller@');
Route::get('/config', 'Controller@');
*/

/*
Ejemplo de la documentación de laravel 5.5
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});
*/
/*
Route::get('/', function () {
    //
})->middleware('auth');
*/
//Route::group(['middleware' => 'auth', 'namespace' => 'Admin'], function () {
Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {
    //User
Route::get('/usuarios', 'UserController@index'); //método get para create cuando carga la primera vez
Route::post('/usuarios', 'UserController@store'); // método post para create, después que se presiona el botón de crear
Route::get('/usuario/{id}', 'UserController@edit'); // editar cuando carga el formulario la primera vez
Route::post('/usuario/{id}', 'UserController@update'); //cuando se hace la petición para hacer los cambios, donde se guarda en db
//post para guardar la info después de que el usuario ha modificado los datos

Route::get('/usuario/{id}/eliminar', 'UserController@delete');


//Project
Route::get('/proyectos', 'ProjectController@index');
//Route::get('/proyectos', 'Admin\ProjectController@index'); Asi se hace cuando no se indica el namespace, se coloca la carpeta donde está el controller

Route::post('/proyectos', 'ProjectController@store'); //Registrar nuevos proyectos
Route::get('/proyecto/{id}', 'ProjectController@edit'); // editar cuando carga el formulario la primera vez
Route::post('/proyecto/{id}', 'ProjectController@update'); //cuando se hace la petición para hacer los cambios, donde se guarda en db

Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');


// Category
Route::post('/categorias', 'CategoryController@store'); //Botón añadir categorías, aquí se guardan en la bd
//Route::post('/categoria/{id}', 'CategoryController@update');
//Editar una categoría
Route::post('/categoria/editar', 'CategoryController@update');
Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');
// esta petición es get porque es un enlace, no hay un formulario para eso

//  Level
Route::post('/niveles', 'LevelController@store');
//Route::post('/nivel/{id}', 'LevelController@update'); //modificar un nivel espoecífico
Route::post('/nivel/editar', 'LevelController@update'); //modificar un nivel espoecífico
Route::get('/nivel/{id}/eliminar', 'LevelController@delete');
// esta petición es get porque es un enlace, no hay un formulario para eso

//Project-User
Route::post('/proyecto-usuario', 'ProjectUserController@store');

Route::get('/config', 'ConfigController@index');
});