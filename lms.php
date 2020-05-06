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

		$this->includes();
		$this->init_classes();

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
        $this->init_hooks();
	}

	public function activate() {

	}

	public function deactivate() {

	}

	public function includes() {
		require_once LMS_INCLUDES . '/Admin.php';
		require_once LMS_INCLUDES . '/Ajax.php';
		require_once LMS_INCLUDES . '/Assets.php';
		require_once LMS_INCLUDES . '/Course.php';
		require_once LMS_INCLUDES . '/Dashboard.php';
		require_once LMS_INCLUDES . '/Email.php';
		require_once LMS_INCLUDES . '/Frontend.php';
		require_once LMS_INCLUDES . '/Gutenberg.php';
		require_once LMS_INCLUDES . '/Instructor.php';
		require_once LMS_INCLUDES . '/Lesson.php';
		require_once LMS_INCLUDES . '/Quiz.php';
		require_once LMS_INCLUDES . '/RestAPI.php';
		require_once LMS_INCLUDES . '/Rewrite.php';
		require_once LMS_INCLUDES . '/Shortcode.php';
		require_once LMS_INCLUDES . '/Student.php';
		require_once LMS_INCLUDES . '/Tools.php';
		require_once LMS_INCLUDES . '/User.php';
		require_once LMS_INCLUDES . '/WithDraw.php';
		require_once LMS_INCLUDES . '/Woocommerce.php';
		require_once LMS_INCLUDES . '/widget/Course.php';
		require_once LMS_INCLUDES . '/settings/Course.php';
	}

	public function init_hooks() {
		add_action( 'init', [ $this, 'localization_setup' ] );

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );
	}

	public function localization_setup() {

	}

	public function init_classes() {
		$this->container['admin']   = new LMS\Admin();
		$this->container['course']  = new LMS\Course();
		$this->container['assets']  = new LMS\Assets();
		$this->container['ajax']    = new LMS\Ajax();
		$this->container['lesson']  = new LMS\Lesson();
		$this->container['quiz']    = new LMS\Quiz();
		$this->container['rewrite'] = new LMS\Rewrite();
		$this->container['user']    = new LMS\User();
	}

	public function plugin_action_links( $links ) {

		return $links;
	}
}

function lms() {
	return Lms::init();
}

lms();
