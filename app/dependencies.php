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

	}
	catch ( PDOException $e ) {
		$c->get( 'logger' )->alert( 'Database connection failed: ' . $e->getMessage() );
	}

	return $qb;
};
/**
 * @param ContainerInterface $c
 *
 * @return \Slim\Views\Twig
 */
$container['view'] = function ( ContainerInterface $c ) {
	$settings = $c->get( 'settings' )['renderer'];
	$view     = new \Slim\Views\Twig(
		$settings['template_path'], [
			'cache' => false
		]
	);

	$view->addExtension(
		new Slim\Views\TwigExtension(
			$c['router'],
			$c['request']->getUri()
		)
	);
	// Allow flash messages inside views.
	// $view->getEnvironment()->addGlobal( 'flash', $c['flash'] );

	/*
	$view->getEnvironment()->addGlobal( 'auth', array(
		'check' => $c->get( 'auth' )->check(),
		'user'  => $c->get( 'auth' )->currentUser()
	) );
	*/

	return $view;
};

$container['google_client'] = function ( ContainerInterface $c ) {
	$client = new \Google_Client(
		array(
			'application_name' => 'flex-calculator',
			'client_id'        => $c['settings']['google']['client_id'],
			'client_secret'    => $c['settings']['google']['client_secret'],
			'redirect_uri'     => $c['settings']['google']['redirect_uri']
		)
	);
	$client->setAccessType('online');
	$client->addScope( \Google_Service_Oauth2::USERINFO_PROFILE );

	return $client;
};

$container['auth'] = function ( ContainerInterface $c ) {
	return new \FlexCalculator\Auth( $c );
};
