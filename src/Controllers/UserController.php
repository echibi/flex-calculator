<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:18
 */

namespace FlexCalculator\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller {
	/**
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return static
	 */
	public function auth_callback( Request $request, Response $response ) {
		$this->logger->addDebug( 'auth_callback started' );

		return $response->withRedirect( $this->router->pathFor( 'home' ) );
	}

	/**
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return static
	 */
	public function get_create_user( Request $request, Response $response ) {
		/**
		 * @var $client \Google_Client
		 */
		$client = $this->app->get( 'GoogleClient' );
		// $client->setAccessType( 'offline' );
		//$client->setIncludeGrantedScopes( true );
		//$client->setApprovalPrompt( 'force' );
		// $client->setState();
		$client->addScope( 'https://www.googleapis.com/auth/userinfo.profile' ); // auth/userinfo.email
		$client->setRedirectUri(
			'http://' . $_SERVER['HTTP_HOST'] . $this->router->pathFor( 'auth_callback' )
		);

		$auth_url = $client->createAuthUrl();

		return $response->withRedirect( $auth_url );
	}
}