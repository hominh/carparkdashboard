<?php

namespace Carparkdashboard\Camera\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Camera\Repositories\Camera\CameraRepositoryInterface;
use Carparkdashboard\Camera\Repositories\Camera\CameraRepository;


class CameraServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(CameraRepositoryInterface::class,CameraRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-camera');
	}
}

?>