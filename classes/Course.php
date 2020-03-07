<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Course {

	public function __construct() {
		add_action( 'init', array( $this, 'register_course_post_types' ) );
		add_action( 'add_meta_boxes', [ $this, 'register_course_box' ] );
		add_action( 'save_post', [ $this, 'save_course_meta' ],10,2 );
	}

	public function register_course_post_types() {
		$args = array(
			'labels' => __('Course',''),
			'public' => true,
		);

		register_post_type( 'course', $args );
	}

	public function register_course_box() {

	}

	public function save_course_meta( $post_id, $post ) {

	}
}