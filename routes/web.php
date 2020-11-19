<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'InicioController')->name('inicio');

Auth::routes(['verify' => true]);

/* Subir Imagen Perfil */
Route::post('/perfil/imagen', 'PerfilController@imagen')->name('perfil.imagen');
Route::post('/perfil/borrarimagen', 'PerfilController@borrarimagen')->name('perfil.borrarimagen');

/* Subri CV Perfil */
Route::post('/perfil/cv', 'PerfilController@cv')->name('perfil.cv');
Route::post('/perfil/borrarcv', 'PerfilController@borrarcv')->name('perfil.borrarcv');

/* Rutas Perfil */
Route::get('/perfil/{perfil}', 'PerfilController@show')->name('perfil.show');
Route::get('/perfil/{perfil}/edit', 'PerfilController@edit')->name('perfil.edit');
Route::put('/perfil/{perfil}', 'PerfilController@update')->name('perfil.update');

/* Rutas Tarea */
Route::get('/tarea/{tarea}/edit', 'TareaController@edit')->name('tarea.edit');
Route::put('/tarea/{tarea}', 'TareaController@update')->name('tarea.update');
Route::delete('/tarea/{tarea}', 'TareaController@destroy')->name('tarea.destroy');
Route::post('/tarea', 'TareaController@store')->name('tarea.store');
Route::get('/tarea/mistareas', 'TareaController@mistareas')->name('tarea.mistareas');
Route::get('/tarea/tareas', 'TareaController@tareas')->name('tarea.tareas');

/* Rutas Imagenes */
Route::post('/imagenes/store', 'ImagenController@store')->name('imagen.store');
Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagen.destroy');

/* Rutas Respuesta Oferta */
Route::post('/respuesta_oferta/store', 'RespuestaOfertaController@store')->name('respuesta_oferta.store');
Route::delete('/respuesta_oferta/{respuesta_oferta}', 'RespuestaOfertaController@destroy')->name('respuesta_oferta.destroy');

/* Rutas Respuesta Pregunta */
Route::post('/respuesta_pregunta/store', 'RespuestaPreguntaController@store')->name('respuesta_pregunta.store');
Route::delete('/respuesta_pregunta/{respuesta_pregunta}', 'RespuestaPreguntaController@destroy')->name('respuesta_pregunta.destroy');

/* Rutas Informacion */
Route::get('/informacion/publicar', 'InformacionController@publicar')->name('informacion.publicar');

/* Rutas Respuesta Pregunta */
Route::post('/respuesta_pregunta/store', 'RespuestaPreguntaController@store')->name('respuesta_pregunta.store');
Route::delete('/respuesta_pregunta/{respuesta_pregunta}', 'RespuestaPreguntaController@destroy')->name('respuesta_pregunta.destroy');

/* Actualizar datos bancarios */
Route::post('/dato_bancario/update', 'DatoBancarioController@update')->name('dato_bancario.update');
