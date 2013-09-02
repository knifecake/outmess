<?php namespace Knifecake\Outmess\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the Outmess component.
 **/
class Outmess extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 **/
	public static function getFacadeAccessor()
	{
		return 'outmess';
	}
}
