<?php
	Route::group(['namespace' => 'Carparkdashboard\Lot\Http\Controllers','middleware' => 'web'], function () {
		Route::get('/lot',['as'=>'lot','uses'=>'LotController@index']);
		Route::get('/lot/create', 'LotController@create');
		Route::post('/lot/store',['as'=>'lot.store','uses'=>'LotController@store']);
		Route::post('/lot/create-slug',['as'=>'lot.create-slug','uses'=>'LotController@createSlug']);
		Route::get('/lot/edit/{id}',['as'=>'lot.edit','uses'=>'LotController@edit']);
		Route::post('/lot/update/{id}',['as'=>'lot.update','uses'=>'LotController@update']);
		Route::post('/lot/updateSettings/{id}',['as'=>'lot.update_settings','uses'=>'LotController@updateSettings']);
		Route::post('/lot/updateSettingPath/{lot_id}/{kiosk_id}',['as'=>'lot.update_setting_path','uses'=>'LotController@updateSettingPath']);
		Route::post('/lot/updateSettingPath2/{lot_id}/{kiosk_id}',['as'=>'lot.update_setting_path2','uses'=>'LotController@updateSettingPath2']);
		Route::get('/lot/destroy/{id}',['as'=>'lot.destroy','uses'=>'LotController@destroy']);
		Route::delete('/lot/multi-destroy',['as'=>'lot.multi-destroy','uses'=>'LotController@destroyMultiRecords']);
		Route::get('/status/settings',['as'=>'status.settings','uses'=>'StatusController@settings']);
		Route::get('/status/setting-path',['as'=>'status.setting-path','uses'=>'StatusController@settingPath']);
		Route::get('/status',['as'=>'status','uses'=>'StatusController@index']);
		Route::get('/status/getdata/{basement}',['as'=>'status.getdata','uses'=>'StatusController@getData']);
		Route::get('/status/initdata/{basement}',['as'=>'status.initdata','uses'=>'StatusController@initData']);
		Route::get('/status/getbyplate/',['as'=>'status.getbyplate','uses'=>'StatusController@getLotByPlate']);
		Route::get('/lot/getPathFromBasement/{basement}',['as'=>'lot.getpath_from_basement','uses'=>'LotController@getPathFromBasement']);
		Route::post('/lot/findLotByCoordinate',['as'=>'lot.findlot','uses'=>'LotController@findLotByCoordinate']);
});