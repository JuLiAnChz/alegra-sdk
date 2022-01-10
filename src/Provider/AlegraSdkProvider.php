<?php

namespace Alegra\SDK\Provider;

use Illuminate\Support\ServiceProvider;

class AlegraSdkProvider extends ServiceProvider
{
	public function boot(): void
	{
		$this->loadConfig();
		$this->loadMigrations();
	}

	private function loadConfig(): void
	{
		$this->publishes(
			[__DIR__ . '/../config/alegra.php' => config_path('alegra.php')],
			'alegra-sdk-config'
		);
	}

	private function loadMigrations(): void
	{
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
		/* $this->publishes(
			[__DIR__ . '/../database/migrations' => database_path('migrations')],
			'alegra-sdk-migrations'
		); TODO: should? */
	}
}
