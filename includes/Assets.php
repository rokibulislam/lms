<?php

namespace LMS;

if ( ! defined( 'ABSPATH' ) ) exit;

class Assets {

	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'register_backend' ), 10 );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 10 );

        add_action( 'wp_enqueue_scripts', [ $this, 'register_frontend' ] );
	}


	public function get_admin_localized_scripts() {
        return [
            'nonce'      => wp_create_nonce( 'lms_nonce' ),
            'ajaxurl'    => admin_url( 'admin-ajax.php' ),
        ];
	}

	public function get_frontend_localized_scripts() {
        return [
            'nonce'      => wp_create_nonce( 'lms_nonce' ),
            'ajaxurl'    => admin_url( 'admin-ajax.php' ),
        ];
	}

	public function register_backend() {
        $this->register_styles( $this->get_admin_styles() );
        $this->register_scripts( $this->get_admin_scripts() );
    }

    public function enqueue_admin_scripts() {
    	$this->enqueue_styles( $this->get_admin_styles() );
        $this->enqueue_scripts( $this->get_admin_scripts() );

        $localize_script = $this->get_admin_localized_scripts();
       
        wp_localize_script( 'lms-admin', 'lms', $localize_script );
    }

	public function register_frontend() {
        $this->register_styles( $this->get_frontend_styles() );
        $this->register_scripts( $this->get_frontend_scripts() );
    }

    public function enqueue_frontend() {
        $this->enqueue_styles( $this->get_frontend_styles() );
        $this->enqueue_scripts( $this->get_frontend_scripts() );

        $localize_script = $this->get_frontend_localized_scripts();

        wp_localize_script( 'lms-frontend', 'lms', $localize_script );
    }

	public function get_admin_styles() {
        $styles = [

        ];

        return $styles;
    }

    public function get_admin_scripts() {
        $scripts = [
            'lms-admin' => [
                'src'       => Directoryx_ASSET_URI . '/js/admin.js',
                'deps'      => [],
                // 'version'   => filemtime( CONTACTUM_PATH . '/assets/js/admin.js' ),
                'version'   => '1.0',
                'in_footer' => true
            ],
        ];

        return $scripts;
    }

	public function get_frontend_styles() {
        $styles = [

        ];

        return $styles;
    }

	public function get_frontend_scripts() {
        $scripts = [

        ];

        return $scripts;
    }

    private function register_scripts( $scripts ) {
        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
            $version   = isset( $script['version'] ) ? $script['version'] : CONTACTUM_VERSION;

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
    }

    public function register_styles( $styles ) {
        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, CONTACTUM_VERSION );
        }
    }

    public function enqueue_scripts( $scripts ) {
        foreach ( $scripts as $handle => $script ) {
            wp_enqueue_script( $handle );
        }
    }

    public function enqueue_styles( $styles ) {
        foreach ( $styles as $handle => $script ) {
            wp_enqueue_style( $handle );
        }
    }

}