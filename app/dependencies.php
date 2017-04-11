<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:01
 */
use Interop\Container\ContainerInterface;

$container = $app->getContainer();

/**
 * @param ContainerInterface $c
 *
 * @return \Monolog\Logger
 */
$container['logger'] = function ( ContainerInterface $c ) {
	$settings = $c->get( 'settings' )['logger'];
	$logger   = new Monolog\Logger( $settings['name'] );

	$logger->pushProcessor( new Monolog\Processor\UidProcessor() );
	$logger->pushHandler( new \Monolog\Handler\RotatingFileHandler( $settings['path'], $settings['max_files'], $settings['level'] ) );

	// $logger->pushHandler( new Monolog\Handler\StreamHandler( $settings['path'], $settings['level'] ) );

	return $logger;
};

/**
 * @param ContainerInterface $c
 *
 * @return bool|\Pixie\QueryBuilder\QueryBuilderHandler
 */
$container['db'] = function ( ContainerInterface $c ) {
	$db = $c['settings']['db'];
	$qb = false;

	try {
		$config = array(
			'driver'    => 'mysql', // Db driver
			'host'      => $db['host'],
			'database'  => $db['dbname'],
			'username'  => $db['user'],
			'password'  => $db['pass'],
			'charset'   => 'utf8', // Optional
			'collation' => 'utf8_swedish_ci', // Optional
		);
		// QB is the new alias for accessing the DB
		$connection = new \Pixie\Connection( 'mysql', $config );
		$qb         = new \Pixie\QueryBuilder\QueryBuilderHandler( $connection );

	} catch ( PDOException $e ) {
		$c->get( 'logger' )->alert( 'Database connection failed: ' . $e->getMessage() );
	}

	return $qb;
};