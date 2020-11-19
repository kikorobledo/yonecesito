<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* Listado de tareas */
Route::get('/tareas', 'APIController@tareas')->name('tareas');

/* Listado de tareas  filtradas*/
Route::post('/tareas_filtradas', 'APIController@filtrarTareas')->name('tareas_filtradas');

/* Listado de ofertas */
Route::get('/ofertas/{id}', 'APIController@ofertas')->name('ofertas');

/* Listado de preguntas */
Route::get('/preguntas/{id}', 'APIController@preguntas')->name('preguntas');

/* Obtener usuario */
Route::get('/usuario/{id}', 'APIController@usuario')->name('usuraio');

/* Actualizar foto de perfil */
Route::post('/actualizar_foto_perfil', 'APIController@actualizar_foto')->name('actualizar_foto');

/* Actualizar telefono de perfil */
Route::post('/actualizar_telefono_perfil', 'APIController@actualizar_telefono')->name('actualizar_telefono');

/* Actualizar fecha de nacimiento */
Route::post('/actualizar_fecha_de_nacimiento_perfil', 'APIController@actualizar_fecha_de_nacimiento')->name('actualizar_fecha_de_nacimiento');

/* Crear Oferta */
Route::post('/oferta', 'APIController@crearOferta')->name('crearOferta');

/* Eliminar Oferta */
Route::delete('/oferta/{oferta}', 'APIController@eliminarOferta')->name('eliminarOferta');

/* Crear Pregunta */
Route::post('/pregunta', 'APIController@crearPregunta')->name('crearPregunta');

/* Eliminar Pregunta */
Route::delete('/pregunta/{pregunta}', 'APIController@eliminarPregunta')->name('eliminarPregunta');
