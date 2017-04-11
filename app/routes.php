<?php
/**
 * @var Slim\App $app
 */
$app->get( '/', '\FlexCalculator\Controllers\HomeController:index' )->setName( 'home' );
$app->get( '/authcallback', '\FlexCalculator\Controllers\UserController:auth_callback' )->setName( 'auth_callback' );
$app->get( '/newuser', '\FlexCalculator\Controllers\UserController:get_create_user' )->setName( 'create_user' );