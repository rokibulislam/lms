<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Assets {

	public function __construct() {
		add_action('admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		add_action('wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
	}

	public function admin_scripts() {

	}

	public function frontend_scripts() {

	}
}