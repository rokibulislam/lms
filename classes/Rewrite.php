<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Rewrite {

	public function __construct() {
		add_filter( 'query_vars', [ $this, 'register_query_vars' ] );
		add_action('generate_rewrite_rules', [ $this, 'add_rewrite_rules' ] );

		add_filter('post_type_link', [ $this, 'change_single_url' ], 1, 2);
	}

	public function register_query_vars( $query_vars ) {

		return $query_vars;
	}

	public function add_rewrite_rules( $wp_rewrite ) {

		return $wp_rewrite;
	}

	public function change_single_url( $post_link, $id=0 ) {

		return $post_link;
	}
}