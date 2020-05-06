<?php

namespace LMS;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Lesson {

	public function __construct() {
		add_action( 'init', array( $this, 'register_lesson_post_types' ) );
		add_action( 'add_meta_boxes', [ $this, 'register_lesson_box' ] );
		add_action( 'save_post', [ $this, 'save_lesson_meta' ],10,2 );
	}

	public function register_lesson_post_types() {
		$args = array(
			'label'        => __( 'Lessons', '' ),
			'labels'       => __('Lesson',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
		);

		register_post_type( 'lesson', $args );
	}

	public function register_lesson_box() {

	}

	public function save_lesson_meta( $post_id, $post ) {

	}
}