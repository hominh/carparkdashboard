<?php
	Route::group(['namespace' => 'Carparkdashboard\Base\Http\Controllers'], function () {
		Route::get('/base', 'BaseController@index');
});