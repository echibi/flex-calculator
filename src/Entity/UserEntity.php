<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 23:27
 */

namespace FlexCalculator\Entity;


class UserEntity extends Entity {
	public $id;
	public $email;

	public function __construct( $data ) {
		$this->id    = $data['id'];
		$this->email = $data['email'];
	}
}