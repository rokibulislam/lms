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
		add_menu_page( __(' LMS', ''), __('LMS', ''), 'manage_options', 'lms', null);

		add_submenu_page( 'lms', __( 'Categories', 'lms' ), __('Categories', 'tutor'), 'manage_options', 'edit-tags.php?taxonomy=course-category&post_type=course', null );
		add_submenu_page('lms', __('Tags', 'lms'), __('Tags', 'lms'), 'manage_options', 'edit-tags.php?taxonomy=course-tag&post_type=course', null );
		add_submenu_page('lms', __('Students', 'lms'), __('Students', 'lms'), 'manage_options', 'lms-students', [ $this, 'lms_students' ] );
		add_submenu_page('lms', __('Instructors', 'lms'), __('Instructors', 'lms'), 'manage_options', 'lms-instructors', [ $this, 'lms_instructors' ]  );

		add_submenu_page('lms', __('Withdraw Requests', 'lms'), __('Withdraw Requests', 'tlmsutor'), 'manage_options', 'lms_withdraw_requests',[ $this, 'withdraw_requests' ] );

		add_submenu_page('lms', __('Settings', 'lms'), __('Settings', 'lms'), 'manage_options', 'lms_settings', [ $this, 'lms_settings' ] );
		add_submenu_page('lms', __('Tools', 'lms'), __('Tools', 'lms'), 'manage_options', 'lms_tools', [ $this, 'lms_tools' ] );
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

	public function lms_students() {

	}

	public function lms_instructors() { ?>
		<div>
			Hello
		</div>
	<?php }

	public function withdraw_requests() {

	}

	public function lms_settings() {

	}

	public function lms_tools() {

	}
}