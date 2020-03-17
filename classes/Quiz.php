<?php

namespace lms\classes;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Quiz {

	public function __construct() {
		add_action( 'init', array( $this, 'register_quiz_post_types' ) );
	}

	public function register_quiz_post_types() {

		$args = array(
			'label'        => __( 'Quizzes', '' ),
			'labels'       => __('Quiz',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
		);

		register_post_type( 'quiz', $args );
	}
}