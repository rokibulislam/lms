<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class User {

	public function __construct() {

		add_action( 'edit_user_profile', [ $this, 'edit_user_profile' ] );
		add_action( 'show_user_profile', [ $this, 'edit_user_profile' ], 10, 1 );

		add_action( 'profile_update', [ $this, 'profile_update' ] );
		add_action( 'set_user_role',  [ $this, 'set_user_role' ], 10, 3 );
	}

	public function edit_user_profile( $user ) {

	}

	public function profile_update( ($user_id ) {

	}
}