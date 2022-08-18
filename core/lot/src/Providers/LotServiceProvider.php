<?php

namespace Carparkdashboard\Lot\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Lot\Repositories\Lot\LotRepositoryInterface;
use Carparkdashboard\Lot\Repositories\Lot\LotRepository;
use Carparkdashboard\Lot\Repositories\LotCamera\LotCameraRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotCamera\LotCameraRepository;
use Carparkdashboard\Lot\Repositories\LotSensor\LotSensorRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotSensor\LotSensorRepository;
use Carparkdashboard\Lot\Repositories\LotPaths\LotPathsRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotPaths\LotPathsRepository;
use Carparkdashboard\Lot\Repositories\LotBasement\LotBasementRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotBasement\LotBasementRepository;

class LotServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(LotRepositoryInterface::class,LotRepository::class);
		$this->app->bind(LotCameraRepositoryInterface::class,LotCameraRepository::class);
		$this->app->bind(LotSensorRepositoryInterface::class,LotSensorRepository::class);
		$this->app->bind(LotPathsRepositoryInterface::class,LotPathsRepository::class);
		$this->app->bind(LotBasementRepositoryInterface::class,LotBasementRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-lot');
	}
}

?>