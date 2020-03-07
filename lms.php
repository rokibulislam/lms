<?php

/**
 * Plugin Name: Lms
 * Description: Description
 * Plugin URI: http://#
 * Author: Author
 * Author URI: http://#
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: text-domain
 * Domain Path: domain/path
 */

/*
    Copyright (C) Year  Author  Email

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


final class Lms {

	public $version = '1.0.0';

	private $container = [];

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
	}

	public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

    public static function init() {
        static $instance = false;

        if ( !$instance ) {
            $instance = new self();
        }

        return $instance;
    }

	public function define_constants() {
		define( 'LMS_VERSION', $this->version );
        define( 'LMS_FILE', __FILE__ );
        define( 'LMS_ROOT', __DIR__ );
        define( 'LMS_INCLUDES', LMS_ROOT . '/includes' );
        define( 'LMS_ROOT_URI', plugins_url( '', __FILE__ ) );
        define( 'LMS_ASSET_URI', LMS_ROOT_URI . '/assets' );
	}

	public function init_plugin() {
		$this->includes();
        $this->init_hooks();
	}

	public function activate() {

	}

	public function deactivate() {

	}

	public function includes() {
		require_once LMS_ROOT . '/classes/Admin.php';
		require_once LMS_ROOT . '/classes/Ajax.php';
		require_once LMS_ROOT . '/classes/Assets.php';
		require_once LMS_ROOT . '/classes/Course.php';
		require_once LMS_ROOT . '/classes/Dashboard.php';
		require_once LMS_ROOT . '/classes/Email.php';
		require_once LMS_ROOT . '/classes/Frontend.php';
		require_once LMS_ROOT . '/classes/Gutenberg.php';
		require_once LMS_ROOT . '/classes/Instructor.php';
		require_once LMS_ROOT . '/classes/Lesson.php';
		require_once LMS_ROOT . '/classes/Quiz.php';
		require_once LMS_ROOT . '/classes/RestAPI.php';
		require_once LMS_ROOT . '/classes/Rewrite.php';
		require_once LMS_ROOT . '/classes/Shortcode.php';
		require_once LMS_ROOT . '/classes/Student.php';
		require_once LMS_ROOT . '/classes/Tools.php';
		require_once LMS_ROOT . '/classes/User.php';
		require_once LMS_ROOT . '/classes/WithDraw.php';
		require_once LMS_ROOT . '/classes/Woocommerce.php';
		require_once LMS_ROOT . '/classes/widget/Course.php';
		require_once LMS_ROOT . '/classes/settings/Course.php';
	}

	public function init_hooks() {
		add_action( 'init', [ $this, 'localization_setup' ] );
		add_action( 'init', [ $this, 'init_classes' ] );

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );
	}

	public function localization_setup() {

	}

	public function init_classes() {
		$this->container['admin']   = new lms\classes\Admin();
		$this->container['course']  = new lms\classes\Course();
		$this->container['assets']  = new lms\classes\Assets();
		$this->container['ajax']    = new lms\classes\Ajax();
		$this->container['lesson']  = new lms\classes\Lesson();
		$this->container['rewrite'] = new lms\classes\Rewrite();
		$this->container['user']    = new lms\classes\User();
	}

	public function plugin_action_links( $links ) {

		return $links;
	}
}

function lms() {
	return Lms::init();
}

lms();
