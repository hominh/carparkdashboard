<?php
	Route::group(['namespace' => 'Carparkdashboard\Kiosk\Http\Controllers','middleware' => 'web'], function () {
		Route::get('/kiosk',['as'=>'kiosk','uses'=>'KioskController@index']);
		Route::get('/kiosk/create', 'KioskController@create');
		Route::post('/kiosk/store',['as'=>'kiosk.store','uses'=>'KioskController@store']);
		Route::get('/kiosk/edit/{id}',['as'=>'kiosk.edit','uses'=>'KioskController@edit']);
		Route::post('/kiosk/update/{id}',['as'=>'kiosk.update','uses'=>'KioskController@update']);
		Route::get('/kiosk/destroy/{id}',['as'=>'kiosk.destroy','uses'=>'KioskController@destroy']);
		Route::delete('/kiosk/multi-destroy',['as'=>'kiosk.multi-destroy','uses'=>'KioskController@destroyMultiRecords']);
		Route::get('/kiosk/settings',['as'=>'kiosk.settings','uses'=>'KioskController@settings']);
		Route::post('/kiosk/updateSettings/{id}',['as'=>'kiosk.update_settings','uses'=>'KioskController@updateSettings']);
		Route::post('/kiosk/getdatabyid',['as'=>'kiosk.getdatabyid','uses'=>'KioskController@getDataById']);
});