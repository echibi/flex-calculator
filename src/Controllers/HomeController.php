<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:13
 */

namespace FlexCalculator\Controllers;


use FlexCalculator\Auth;
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

		$viewData = array();
		/**
		 * @var $auth   Auth
		 */
		$auth = $this->app->get( 'auth' );

		if ( $auth->check() ) {
			$viewData['title'] = 'logged in.' . $auth->get_current_user();
		} else {
			$viewData['title'] = 'not logged in.';
		}

		return $this->view->render(
			$response, 'home.twig',
			$viewData
		);
	}
}