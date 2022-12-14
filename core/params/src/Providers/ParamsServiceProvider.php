<?php

namespace Carparkdashboard\Params\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Params\Repositories\Params\ParamsRepositoryInterface;
use Carparkdashboard\Params\Repositories\Params\ParamsRepository;
use Validator;

class ParamsServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(ParamsRepositoryInterface::class,ParamsRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-params');
	}
}

?>