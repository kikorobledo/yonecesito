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

Route::group(['middleware' => ['auth', 'verified']], function(){
    /* Subir/borrar Imagen Perfil */
    Route::post('/perfil/imagen', 'PerfilController@imagen')->name('perfil.imagen');
    Route::post('/perfil/borrarimagen', 'PerfilController@borrarimagen')->name('perfil.borrarimagen');

    /* Subri/borrar CV Perfil */
    Route::post('/perfil/cv', 'PerfilController@cv')->name('perfil.cv');
    Route::post('/perfil/borrarcv', 'PerfilController@borrarcv')->name('perfil.borrarcv');

    /* Rutas Perfil */
    Route::get('/perfil/{perfil}/edit', 'PerfilController@edit')->name('perfil.edit');
    Route::put('/perfil/{perfil}', 'PerfilController@update')->name('perfil.update');

    /* Rutas Tarea */
    Route::get('/tarea/{tarea}/edit', 'TareaController@edit')->name('tarea.edit');
    Route::put('/tarea/{tarea}', 'TareaController@update')->name('tarea.update');
    Route::delete('/tarea/{tarea}', 'TareaController@destroy')->name('tarea.destroy');
    Route::post('/tarea', 'TareaController@store')->name('tarea.store');
    Route::get('/tarea/mistareas', 'TareaController@mistareas')->name('tarea.mistareas');

    /* Rutas Imagenes */
    Route::post('/imagenes/store', 'ImagenController@store')->name('imagen.store');
    Route::post('/imagenes/destroy', 'ImagenController@destroy')->name('imagen.destroy');

    /* Rutas Respuesta Oferta */
    Route::post('/respuesta_oferta/store', 'RespuestaOfertaController@store')->name('respuesta_oferta.store');
    Route::delete('/respuesta_oferta/{respuesta_oferta}', 'RespuestaOfertaController@destroy')->name('respuesta_oferta.destroy');

    /* Rutas Respuesta Pregunta */
    Route::post('/respuesta_pregunta/store', 'RespuestaPreguntaController@store')->name('respuesta_pregunta.store');
    Route::delete('/respuesta_pregunta/{respuesta_pregunta}', 'RespuestaPreguntaController@destroy')->name('respuesta_pregunta.destroy');

    /* Rutas Respuesta Pregunta */
    Route::post('/respuesta_pregunta/store', 'RespuestaPreguntaController@store')->name('respuesta_pregunta.store');
    Route::delete('/respuesta_pregunta/{respuesta_pregunta}', 'RespuestaPreguntaController@destroy')->name('respuesta_pregunta.destroy');

    /* Actualizar datos bancarios */
    Route::post('/dato_bancario/update', 'DatoBancarioController@update')->name('dato_bancario.update');

    /* Notificaciones Ofertas */
    Route::get('/notificaciones_ofertas', 'NotificacionesController@ofertas')->name('notificaciones.ofertas');

    /* Notificaciones Preguntas */
    Route::get('/notificaciones_preguntas', 'NotificacionesController@preguntas')->name('notificaciones.preguntas');

    /* Notificaciones Respuestas */
    Route::get('/notificaciones_respuestas', 'NotificacionesController@respuestas')->name('notificaciones.respuestas');

    /* Notificaciones Asignaciones */
    Route::get('/notificaciones_asignaciones', 'NotificacionesController@asignaciones')->name('notificaciones.asignaciones');

    /* Mensajes */
    Route::get('/mensajes', 'MensajeController@misMensajes')->name('mensajes.mis_mensajes');

    /* Rating */
    Route::get('/rating', 'TareaController@rating')->name('tarea.rating');

    /* Guardar Reseña */
    Route::post('/resena/store', 'ResenaController@store')->name('resena.store');
});

/* Ruta Tareas */
Route::get('/tareas', 'TareaController@tareas')->name('tarea.tareas');

/* Rutas Perfil */
Route::get('/perfil/{perfil}', 'PerfilController@show')->name('perfil.show');


/* Rutas Informacion */
Route::get('/informacion/publicar', 'InformacionController@publicar')->name('informacion.publicar');
