<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:16
 */

namespace FlexCalculator\Models;


use Interop\Container\ContainerInterface;
use Pixie\QueryBuilder\QueryBuilderHandler;

class Model {
	/**
	 * @var QueryBuilderHandler
	 */
	protected $db;
	/**
	 * @var ContainerInterface
	 */
	protected $app;

	/**
	 * @param ContainerInterface $app
	 */
	public function __construct( ContainerInterface $app ) {
		$this->app = $app;
		$this->db  = $app->get( 'db' );
	}
}