<?php namespace Knifecake\Outmess;

use Illuminate\Support\ServiceProvider;

class OutmessServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('knifecake/outmess');

		// Bring the application container into the local scope so we can
		// import it into the filters scope
		$app = $this->app;

		$this->app->close(function() use ($app)
		{
			// preserve messages in session
			$app['outmess']->flash();
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['outmess'] = $this->app->share(function($app)
		{
			return new Outmess($app['config'], $app['session']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('outmess');
	}

}
