<?php

namespace Carparkdashboard\Basement\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepositoryInterface;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepository;
use Carparkdashboard\Basement\Repositories\BasementKiosk\BasementKioskRepositoryInterface;
use Carparkdashboard\Basement\Repositories\BasementKiosk\BasementKioskRepository;


class BasementServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(BasementRepositoryInterface::class,BasementRepository::class);
		$this->app->bind(BasementKioskRepositoryInterface::class,BasementKioskRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-basement');
	}
}

?>