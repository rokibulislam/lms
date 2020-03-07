<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menu' ] );

		add_filter('parent_file', [ $this, 'parent_menu_active' ] );
		add_filter('submenu_file', [ $this, 'submenu_file_active' ], 10, 2);

		add_filter( 'admin_footer_text', [ $this, 'admin_footer_text' ], 1 );
	}

	public function register_menu() {
		add_menu_page( __(' LMS', ''), __('LMS', ''), 'manage_options', 'tutor', null);
	}

	public function parent_menu_active( $parent_file ) {

		return $parent_file;
	}

	public function submenu_file_active( $submenu_file, $parent_file ) {

		return $submenu_file;
	}

	public function admin_footer_text( $footer_text ) {

		return $footer_text;
	}
}