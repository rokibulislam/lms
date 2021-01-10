<?php

namespace LMS;

class post_type {

	public function __construct( $name, $singluar_name, $type, $args ){
		$this ->register_post_type($name, $singluar_name, $type, $args);
	}

	//Registering Post Types
	public function register_post_type( $name, $singluar_name, $type, $args ) {

	    $args = array_merge(
			array(
				'labels' => array(
					'name' 			=> _x( $name, 'directoryx' ),
					'singular_name' => _x( $singluar_name, 'directoryx' ),
					'add_new'		=> _x( "Add New $singluar_name", 'directoryx'),
					'add_new_item' 	=> _x( "Add New $singluar_name", 'directoryx'),
					'edit_item' 	=> __( "Edit $singluar_name", 'directoryx' ),
					'new_item' 		=> __( "New $singluar_name", 'directoryx' ),
					'view_item' 	=> __( "View $singluar_name", 'directoryx' ),
					'search_items' 	=> __( "Search $name", 'directoryx'),
					'not_found' 	=> __( "No $name found", 'directoryx'),
					'all_items' => __( "All $name", 'directoryx' ),
					'not_found_in_trash' 	=> __("No $name found in Trash", 'directoryx' ),
					'parent_item_colon' 	=> __( '', 'directoryx'),
					'menu_name' 	=>  _x( $type, 'directoryx' )
				),
				'public' 	=> true,
				'show_in_rest' => true,
				'query_var' => strtolower( $type ),
				'hierarchical' => true,
				'rewrite' 	=> array('slug' => $type),
				'supports' 	=> array(''),
			),
			$args
	    );

		register_post_type(strtolower($type),$args);
	}

	//Taxonomies
	public function taxonomies( $post_types, $tax_arr ) {

		$taxonomies = array();

		foreach ($tax_arr as $name => $arr){

			$singular_name = $arr['singular_name'];

			$labels = array(
				'name' => _x( $singular_name, 'directoryx' ),
				'singular_name' => _x( $singular_name, 'directoryx' ),
				'add_new' => _x( "Add New $singular_name", 'directoryx' ),
				'add_new_item' => _x( "Add New $singular_name", 'directoryx'),
				'edit_item' => __( "Edit $singular_name", 'directoryx' ),
				'new_item' => __( "New $singular_name", 'directoryx' ),
				'view_item' => __( "View $singular_name", 'directoryx' ),
				'update_item' => __( "Update $singular_name", 'directoryx'),
				'search_items' => __( "Search $singular_name", 'directoryx' ),
				'not_found' => __ ( "$singular_name Not Found", 'directoryx' ),
				'not_found_trash' => __ ( "$singular_name Not Found in Trash", 'directoryx' ),
				'all_items' => __( "All $singular_name", '' ),
				'separate_items_with_comments' => __( "Separate tags with commas", 'directoryx' )
			);

			$defaultArr = array(
				'hierarchical' => true,
				'query_var' => true,
				'rewrite' => array('slug' => $name),
				'labels' => $labels,
				'show_in_rest' => true
			);

			$taxonomies[$name] =  array_merge($defaultArr, $arr);
		}

		$this->register_all_taxonomies( $post_types, $taxonomies );
	}

	public function register_all_taxonomies( $post_types, $taxonomies ) {
		foreach( $taxonomies as $name => $arr ) {
			register_taxonomy(strtolower($name),strtolower($post_types), $arr);
		}
	}
}