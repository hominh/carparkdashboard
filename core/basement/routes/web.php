<?php
	Route::group(['namespace' => 'Carparkdashboard\Basement\Http\Controllers','middleware' => 'web'], function () {
		Route::get('/basement',['as'=>'basement','uses'=>'BasementController@index']);
		Route::get('/basement/create', 'BasementController@create');
		Route::post('/basement/store',['as'=>'basement.store','uses'=>'BasementController@store']);
		Route::get('/basement/edit/{id}',['as'=>'basement.edit','uses'=>'BasementController@edit']);
		Route::post('/basement/getdatabyid',['as'=>'basement.getdatabyid','uses'=>'BasementController@getDataById']);
		Route::post('/basement/update/{id}',['as'=>'basement.update','uses'=>'BasementController@update']);
		Route::get('/basement/destroy/{id}',['as'=>'basement.destroy','uses'=>'BasementController@destroy']);
		Route::delete('/basement/multi-destroy',['as'=>'basement.multi-destroy','uses'=>'BasementController@destroyMultiRecords']);

});