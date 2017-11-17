<?php

namespace CellV\LaravelPosts;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class LaravelPostsServiceProvider extends ServiceProvider {

	private $packageName = 'LaravelPosts';

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot() {
		// use this if your package has views
		$this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'LaravelPosts');

		// use this if your package has lang files
		$this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'LaravelPosts');

		// use this if your package has routes
		// $this->setupRoutes($this->app->router);
		$this->loadRoutesFrom(__DIR__ . '/Http/routes.php');

		// use this if your package needs a config file
		// $this->publishes([
		//         __DIR__.'/config/config.php' => config_path('LaravelPosts.php'),
		// ]);

		// use the vendor configuration file as fallback
		// $this->mergeConfigFrom(
		//     __DIR__.'/config/config.php', 'LaravelPosts'
		// );

		// $this->publishes([
		//         __DIR__.'/../database/migrations/' => database_path('migrations')
		//     ], 'migrations');
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		//  $this->loadViewsFrom(__DIR__.'/views/post', 'post');
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router) {
		$router->group(['namespace' => 'CellV\LaravelPosts\Http\Controllers'], function ($router) {
			require __DIR__ . '/Http/routes.php';
		});
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register() {
		$this->registerThisPackage();

		// use this if your package has a config file
		// config([
		//         'config/LaravelPosts.php',
		// ]);
	}

	private function registerThisPackage() {
		$packageName = $this->packageName;
		$this->app->bind($packageName, function ($app) use ($packageName) {
			return new $packageName($app);
		});
		// $this->app->bind('LaravelPosts', function ($app) {
		// 	return new LaravelPosts($app);
		// });
	}
}
