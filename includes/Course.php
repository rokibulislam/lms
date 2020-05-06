<?php

namespace LMS;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Course {

	public function __construct() {
		add_action( 'init', [ $this, 'register_course_post_types' ] );
		add_action( 'init', [ $this, 'register_topic_post_types' ] );
		add_action( 'init', [ $this, 'register_assignments_post_types' ] );
		add_action( 'init', [ $this, 'register_enrolled_post_types' ] );

		add_action( 'add_meta_boxes', [ $this, 'register_course_box' ] );
		add_action( 'save_post', [ $this, 'save_course_meta' ],10,2 );
	}

	public function register_course_post_types() {

		$args = array(
			'label'       => __( 'Course', '' ),
			'labels'       => __('Course',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
			'show_in_rest' => true
		);

		register_post_type( 'course', $args );

		$course_cat_args = array(
        	'label'        => __( 'Category', '' ),
        	'public'       => true,
        	'rewrite'      => false,
        	'hierarchical' => true,
        	'show_ui'	   => true,
        	'show_in_menu' => 'lms',
        	'show_in_rest' => true
    	);

    	register_taxonomy( 'course-category', 'course', $course_cat_args );

    	$course_tag_args = array(
        	'label'        => __( 'Tag', '' ),
        	'public'       => true,
        	'rewrite'      => false,
        	'hierarchical' => true,
        	'show_ui'	   => true,
        	'show_in_menu' => 'lms',
        	'show_in_rest' => true
    	);

    	register_taxonomy( 'course-tag', 'course', $course_tag_args );
	}

	public function register_topic_post_types() {
		$args = array(
			'label'       => __( 'Topic', '' ),
			'labels'       => __('Topics',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
			'show_in_rest' => true
		);

		register_post_type( 'topics', $args );
	}

	public function register_assignments_post_types() {
		$args = array(
			'label'       => __( 'Assignment', '' ),
			'labels'       => __('Assignments',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
			'show_in_rest' => true
		);

		register_post_type( 'assignments', $args );
	}

	public function register_enrolled_post_types() {

		$args = array(
			'label'       => __( 'Enrolled', '' ),
			'labels'       => __('Enrolls',''),
			'public'       => true,
			'show_ui'      => true,
			'show_in_menu' => 'lms',
			'show_in_rest' => true
		);

		register_post_type( 'enroll', $args );

	}

	public function register_course_box() {

	}

	public function save_course_meta( $post_id, $post ) {

	}
}