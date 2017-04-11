<?php
/**
 * @var Slim\App $app
 */
$app->get( '', '\FlexCalculator\Controllers\HomeController:index' )->setName( 'home' );