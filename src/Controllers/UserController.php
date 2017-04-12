<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 22:18
 */

namespace FlexCalculator\Controllers;


use FlexCalculator\Auth;
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
		/**
		 * @var $client \Google_Client
		 */
		$client = $this->app->get( 'google_client' );
		// $client->addScope( \Google_Service_Oauth2::USERINFO_PROFILE );
		if ( isset( $_GET['code'] ) ) {
			if ( strval( $_SESSION['auth_state'] ) !== strval( $_GET['state'] ) ) {
				die( 'The session state did not match.' );
			}
			$token = $client->fetchAccessTokenWithAuthCode( $_GET['code'] );
			// $client->setAccessToken( $token );
			$_SESSION['auth_token'] = $token;
		}

		return $response->withRedirect( $this->router->pathFor( 'home' ) );
	}

	/**
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return static
	 */
	public function auth_user( Request $request, Response $response ) {
		$this->logger->addDebug( 'auth_user started' );
		/**
		 * @var $client \Google_Client
		 */
		$client = $this->app->get( 'google_client' );

		$_SESSION['auth_state'] = md5( uniqid( rand(), true ) );
		$client->setState( $_SESSION['auth_state'] );

		$auth_url = $client->createAuthUrl();

		return $response->withRedirect( $auth_url );
	}

	public function login_user( Request $request, Response $response ) {
		$this->logger->addDebug( 'login_user started', array( $_SESSION ) );
		/**
		 * @var $auth   Auth
		 * @var $client \Google_Client
		 */
		$auth = $this->app->get( 'auth' );

		if ( isset( $_SESSION['auth_token'] ) ) {
			$client = $this->app->get( 'google_client' );
			$client->setAccessToken( $_SESSION['auth_token'] );

			$oauth    = new \Google_Service_Oauth2( $client );
			$userData = $oauth->userinfo->get();
			if ( $userData->id ) {
				$auth->login( $userData->id );
			}

			return $response->withRedirect( $this->router->pathFor( 'home' ) );
		} else {
			return $response->withRedirect( $this->router->pathFor( 'auth_user' ) );
		}
	}

	public function logout_user( Request $request, Response $response ) {
		/**
		 * @var $auth Auth
		 */
		$auth = $this->app->get( 'auth' );
		$auth->logout();

		return $response->withRedirect( $this->router->pathFor( 'home' ) );
	}
}