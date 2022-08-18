<?php

namespace Carparkdashboard\Kiosk\Providers;

use Illuminate\Support\ServiceProvider;
use Carparkdashboard\Kiosk\Repositories\Kiosk\KioskRepositoryInterface;
use Carparkdashboard\Kiosk\Repositories\Kiosk\KioskRepository;


class KioskServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind(KioskRepositoryInterface::class,KioskRepository::class);
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-kiosk');
	}
}

?>