<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 12/04/2017
 * Time: 22:42
 */

namespace FlexCalculator;


use Interop\Container\ContainerInterface;

class Auth {
	function __construct( ContainerInterface $app ) {
		$this->app = $app;
		$this->db  = $this->app->get( 'db' );
	}

	public function check() {
		return isset( $_SESSION['user_id'] );
	}

	public function login( $id ) {
		$_SESSION['user_id'] = $id;
	}

	public function get_current_user() {
		return $_SESSION['user_id'];
	}

	public function logout() {
		unset( $_SESSION['user_id'] );
	}
}