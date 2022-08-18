<?php
	Route::group(['namespace' => 'Carparkdashboard\Camera\Http\Controllers','middleware' => 'web'], function () {
		Route::get('/camera',['as'=>'camera','uses'=>'CameraController@index']);
		Route::get('/camera/create', 'CameraController@create');
		Route::post('/camera/store',['as'=>'camera.store','uses'=>'CameraController@store']);
		Route::post('/camera/create-slug',['as'=>'camera.create-slug','uses'=>'CameraController@createSlug']);
		Route::get('/camera/edit/{id}',['as'=>'camera.edit','uses'=>'CameraController@edit']);
		Route::post('/camera/update/{id}',['as'=>'camera.update','uses'=>'CameraController@update']);
		Route::get('/camera/destroy/{id}',['as'=>'camera.destroy','uses'=>'CameraController@destroy']);
		Route::delete('/camera/multi-destroy',['as'=>'camera.multi-destroy','uses'=>'CameraController@destroyMultiRecords']);

});