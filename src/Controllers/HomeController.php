<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:13
 */

namespace FlexCalculator\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller {
	/**
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function index( Request $request, Response $response ) {
		return $this->view->render( $response, 'home.twig',
			array(
				'hej' => 'Hallå',
			)
		);
	}
}