<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:13
 */

namespace FlexCalculator\Controllers;


use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Slim\Router;
use Slim\Views\Twig;

class Controller {
	/**
	 * @var ContainerInterface
	 */
	protected $app;
	/**
	 * @var Twig
	 */
	protected $view;
	/**
	 * @var Logger
	 */
	protected $logger;
	/**
	 * @var Router
	 */
	protected $router;

	/**
	 * @param ContainerInterface $app
	 */
	public function __construct( ContainerInterface $app ) {
		$this->$app   = $app;
		$this->logger = $app->get( 'logger' );
		$this->router = $app->get( 'router' );
		$this->view   = $app->get( 'view' );
	}
}