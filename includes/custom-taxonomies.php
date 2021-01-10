<?php

namespace LMS;

if ( ! defined( 'ABSPATH' ) )
	exit;

class CustomTaxonomies {

	public function __construct() {
		add_action( 'course-category_add_form_fields', [ $this, 'add_category_fields' ] );
		add_action( 'course-category_edit_form_fields', array( $this, 'edit_category_fields' ) );
		add_action( 'created_term', array( $this, 'save_category_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_category_fields' ), 10, 3 );
		add_filter( 'manage_edit-course-category_columns', array( $this, 'course_category_columns' ) );
		add_filter( 'manage_course-category_custom_column', array( $this, 'course_category_column' ), 10, 3 );
	}

	public function add_category_fields() {

	}

	public function edit_category_fields( $term ) {

	}

	public function save_category_fields( $term_id, $tt_id, $taxonomy ) {

	}

	public function course_category_columns( $columns ) {

		return $columns;
	}
}
