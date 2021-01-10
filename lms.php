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

if ( !defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/vendor/autoload.php';

final class Lms {

	public $version = '1.0.0';

	private $container = [];

	public function __construct() {
		$this->define_constants();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

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

	public function init_hooks() {
		add_action( 'init', [ $this, 'localization_setup' ] );
	}

	public function localization_setup() {
        load_plugin_textdomain( 'lms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function init_classes() {
		$this->container['admin']         = new LMS\Admin();
		$this->container['course']        = new LMS\Course();
		$this->container['assets']        = new LMS\Assets();
		$this->container['ajax']          = new LMS\Ajax();
		$this->container['rewrite']       = new LMS\Rewrite();
        $this->container['user']          = new LMS\User();
        $this->container['email']         = new LMS\Email();
        $this->container['frontend']      = new LMS\Frotnend();
        $this->container['shortcode']     = new LMS\Shortcode();
        $this->container['user']          = new LMS\User();
		$this->container['custom_taxonomies'] = new LMS\CustomTaxonomies();
	}
}

function lms() {
	return Lms::init();
}

lms();
