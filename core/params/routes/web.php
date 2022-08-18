<?php
	Route::group(['namespace' => 'Carparkdashboard\Params\Http\Controllers'], function () {
		Route::post('/params/getdatabyparamname/',['as'=>'params.getdatabyparamname','uses'=>'ParamsController@getDataByParamname']);
});