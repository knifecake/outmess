<?php

return array(

	'enabled' => true,

	/**
	 * The default style to be used. Needs to be in the defined 'styles' array.
	 **/
	'style' => 'bootstrap',

	 /**
	  * Styles available to be used. Each style conains a string for each message type
		* you want to use. Feel free to define new ones. ':message' will be replaced by
		* the message being rendered.
	  **/
	'styles' => array(
		'bootstrap' => array(
			'error'		=> '<p class="alert alert-danger">:message</p>',
			'warning'	=> '<p class="alert alert-warning">:message</p>',
			'info'		=> '<p class="alert alert-info">:message</p>',
			'success'	=> '<p class="alert alert-success">:message</p>',
		),

		'bootstrap-with-fontawesome' => array(
			'error'		=> '<p class="alert alert-danger"><i class="icon icon-close"></i> :message</p>',
			'warning'	=> '<p class="alert alert-warning"><i class="icon icon-warning-sign"></i> :message</p>',
			'info'		=> '<p class="alert alert-info"><i class="icon icon-info-sign"></i> :message</p>',
			'success'	=> '<p class="alert alert-success"><i class="icon icon-ok"></i> :message</p>',
		),
	),
);
