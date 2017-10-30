<?php

namespace App\Component\Packages\Example\Greeting;

use App\Component\Providers\ServiceProviders\ServiceProvidersFactory as ServiceProviders;

class GreetingServiceProvider extends ServiceProviders
{
	/**
	 * 
	 * Illuminating all instance that has definied/registered before
	 * to the all controller class
	 * you'll be able to use instance of any class with $this->auth and etcetera...
	 * 
	 * @return instance object
	 * 
	 */
	public function boot()
	{
		$this->boot = [
			'greeting'	    => $this->getProvider('greeting')
		];
	}

	public function register()
	{
		$this->set([ 'greeting'	=> __DIR__."/routers.php" ]);
	}
}
