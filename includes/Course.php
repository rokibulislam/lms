<?php

namespace LMS;
use LMS\post_type;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Course {

	public function __construct() {
		add_action( 'init', [ $this, 'register_course_post_types' ] );
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

		$course_args          = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$course               = new post_type( 'Course', 'course', 'course', $course_args );
		$course_cat_args = array( 'course-category' => array( 'singular_name' => 'Category', 'query_var'=> true, 'show_in_menu' => 'lms' ) );
		$course->taxonomies('course', $course_cat_args );
		$course_tag_args = array( 'course-tag' => array( 'singular_name' => 'Tag', 'query_var'=> true, 'show_in_menu' => 'lms' ) );
		$course->taxonomies('course', $course_tag_args );

		$topics_args          = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$topics               = new post_type( 'Topics', 'Topic', 'topics', $topics_args );

		$assignments_args  = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$assignments       = new post_type( 'Assignments', 'Assignment', 'assignments', $topics_args );

		$enroll_args  = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$enroll       = new post_type( 'Enrolls', 'Enrolled', 'enroll', $enroll_args );

		$quiz_args  = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$quiz       = new post_type( 'Quizzes', 'Quiz', 'quiz', $quiz_args );
		
		$lesson_args  = array( 'show_in_menu' => 'lms', 'supports' => array( 'title', 'editor', 'thumbnail', 'author' ), 'has_archive' => true );
		$lesson       = new post_type( 'Lessons', 'lesson', 'lesson', $lesson_args );
	}
}