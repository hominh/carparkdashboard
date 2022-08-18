<?php
	Route::group(['namespace' => 'Carparkdashboard\Sensor\Http\Controllers','middleware' => 'web'], function () {
		Route::get('/sensor',['as'=>'sensor','uses'=>'SensorController@index']);
		Route::get('/sensor/create', 'SensorController@create');
		Route::post('/sensor/store',['as'=>'sensor.store','uses'=>'SensorController@store']);
		Route::post('/sensor/create-slug',['as'=>'sensor.create-slug','uses'=>'SensorController@createSlug']);
		Route::get('/sensor/edit/{id}',['as'=>'sensor.edit','uses'=>'SensorController@edit']);
		Route::post('/sensor/update/{id}',['as'=>'sensor.update','uses'=>'SensorController@update']);
		Route::get('/sensor/destroy/{id}',['as'=>'sensor.destroy','uses'=>'SensorController@destroy']);
		Route::delete('/sensor/multi-destroy',['as'=>'sensor.multi-destroy','uses'=>'SensorController@destroyMultiRecords']);

});