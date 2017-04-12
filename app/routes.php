<?php
/**
 * @var Slim\App $app
 */
$app->get( '/', '\FlexCalculator\Controllers\HomeController:index' )->setName( 'home' );
$app->get( '/authcallback', '\FlexCalculator\Controllers\UserController:auth_callback' )->setName( 'auth_callback' );
$app->get( '/authuser', '\FlexCalculator\Controllers\UserController:auth_user' )->setName( 'auth_user' );
$app->get( '/login', '\FlexCalculator\Controllers\UserController:login_user' )->setName( 'login_user' );
$app->get( '/logout', '\FlexCalculator\Controllers\UserController:logout_user' )->setName( 'logout_user' );