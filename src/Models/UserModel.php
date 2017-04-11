<?php
/**
 * Created by PhpStorm.
 * User: echibi
 * Date: 11/04/2017
 * Time: 23:26
 */

namespace FlexCalculator\Models;


use FlexCalculator\Entity\UserEntity;

class UserModel extends Model {
	const TABLE = 'users';

	/**
	 * @param        $id
	 * @param string $field
	 *
	 * @return UserEntity|null
	 */
	public function get( $id, $field = 'id' ) {
		$object = $this->db->table( self::TABLE )->find( $id, $field );
		if ( $object ) {
			return new UserEntity(
				array(
					'id'    => $object->id,
					'email' => $object->email,
				)
			);
		} else {
			return null;
		}
	}

	public function create( UserEntity $user ) {
		$query = $this->db->table( self::TABLE );

		return $query->insert(
			array(
				'email' => $user->email
			)
		);
	}
}