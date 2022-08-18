<?php

namespace Carparkdashboard\Sensor\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepositoryInterface;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepository;


class SensorServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(SensorRepositoryInterface::class,SensorRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-sensor');
	}
}

?>