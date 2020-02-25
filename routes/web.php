<?php


Route::get('/', function () {
    return view('index');
});

Route::get('/frutas', 'FrutaController@indexFrutas')->name('fruites');
Route::get('/frutas/viewFruta', 'FrutaController@vitsaFruita')->name('vistaFruita'); //para ver elformulario de añadir
Route::post('/frutas/crearFruta', 'FrutaController@crearFruta')->name('crearFruites'); //para guardar la fruta añadida
Route::delete('/fruta/{nombre}', 'FrutaController@delete')->name('eliminarFruites');
Route::put('/fruta/{nombre}', 'FrutaController@editarFruita')->name('editarFruites');
Route::get('/fruta/{nombre}', 'FrutaController@vitsaEditarFruita')->name('vistaEditarFruites');


?>
