<?php namespace Knifecake\Outmess;

use Illuminate\Config\Repository;
use Illuminate\Session\Store;

/**
 * Handles creation and rendering of messages.
 **/
class Outmess
{
	/**
	 * Added messages.
	 *
	 * @var array
	 **/
	protected $messages = array();

	/**
	 * The placeholder used in message type strings.
	 *
	 * @var string
	 **/
	protected $placeholder = ':message';

	/**
	 * The style we are using.
	 *
	 * @var string
	 **/
	public $style;

	/**
	 * The types of messages available, as defined in the style's config.
	 *
	 * @var array
	 **/
	public $types = array();

	/**
	 * Illuminate config repository.
	 *
	 * @var Illuminate\Config\Repository
	 **/
	protected $config;

	/**
	 * Illuminate session store.
	 *
	 * @var Illuminate\Config\Repository
	 **/
	protected $session;

	/**
	 * Load configuration for the messager.
	 **/
	public function __construct(Repository $config, Store $session)
	{
		$this->config = $config;
		$this->session = $session;

		// load the default style and look for available types
		$this->style = $this->config->get('outmess::style');
		$this->types = $this->types();

		// load previous messages if any
		$this->messages = $this->session->get('outmessages', array());
	}

	/**
	 * Adds a new message.
	 **/
	public function add($type, $message)
	{
		$this->messages[] = array(
			'type' => $type,
			'message' => $message,
		);
	}

	/**
	 * Renders all messages as HTML.
	 **/
	public function render()
	{
		if (!$this->config->get('outmess::enabled')) return '';

		$output = '';

		foreach ($this->messages as $message)
			$output .= $this->renderOne($message);

		return $output;
	}

	/**
	 * Sets the default style.
	 *
	 * @param string $style
	 * @return void
	 **/
	public function style($style)
	{
		$this->style = $style;

		// reload the available types for the style
		$this->types = $this->types();
	}

	/**
	 * Flashes messages to session for next request.
	 **/
	public function flash()
	{
		$this->session->flash('outmessages', $this->messages);
	}

	/**
	 * Outputs HTML code for one message.
	 *
	 * @param array $message
	 * @return string
	 **/
	protected function renderOne($message)
	{
		return str_replace($this->placeholder, $message['message'], $this->config->get('outmess::styles.' . $this->style . '.' . $message['type'])); 
	}

	/**
	 * Returns the message types defined in the current style.
	 * 
	 * @return array
	 **/
	protected function types()
	{
		return array_keys($this->config->get('outmess::styles.' . $this->style)); 
	}

	/**
	 * Dynamically handle message additions.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function __call($method, $parameters)
	{
		if (in_array($method, $this->types))
		{
			return call_user_func_array(array($this, 'add'), array_merge(array($method), $parameters));
		}

		throw new \BadMethodCallException("Method [$method] does not exist.");
	}
}
