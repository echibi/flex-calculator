<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 21:43
 */

// Autoload our app
require( __DIR__ . '/../vendor/autoload.php' );

session_start();

// Instantiate the app
$settings = require __DIR__ . '/settings.php';
$app      = new \Slim\App( $settings );

// Set up dependencies
require __DIR__ . '/dependencies.php';

// Register middleware
require __DIR__ . '/middleware.php';

// Register routes
require __DIR__ . '/routes.php';

// Run app
$app->run();