<?php
	Route::group(['namespace' => 'Carparkdashboard\Params\Http\Controllers'], function () {
		Route::get('/params',['as'=>'params','uses'=>'ParamsController@index']);
		Route::post('/params/getdatabyparamname/',['as'=>'params.getdatabyparamname','uses'=>'ParamsController@getDataByParamname']);
		Route::post('/params/updateparams',['as'=>'params.updateparams','uses'=>'ParamsController@updateparams']);
});