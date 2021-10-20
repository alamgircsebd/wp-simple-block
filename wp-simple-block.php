<?php
/**
 * Plugin Name: WP Simple Block
 * Plugin URI: https://github.com/alamgircsebd
 * Description: Getting started with simplge Gutenberg block development.
 * Author: Alamgir Hossain
 * Version: 1.0.0
 * Text Domain: wp-simple-block
 * Domain Path: /languages
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'WPSimpleBlock' ) ) :

    /**
     * Main WPSimpleBlock Class.
     *
     * @since 1.0.0
     */
    final class WPSimpleBlock {

        /**
         * This plugin's instance.
         *
         * @since 1.0.0
         * 
         * @var WPSimpleBlock
         */
        private static $instance;

        /**
         * Main WPSimpleBlock Instance.
         *
         * Insures that only one instance of WPSimpleBlock exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         *
         * @since 1.0.0
         * 
         * @static
         * @return object|WPSimpleBlock The one true WPSimpleBlock
         */
        public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WPSimpleBlock ) ) {
                self::$instance = new WPSimpleBlock();
                self::$instance->define_constants();
                self::$instance->includes();
                self::$instance->dependency_class_instance();
            }

            return self::$instance;
        }

        /**
         * Define woogool Constants
         * 
         * @since 1.0.0
         *
         * @return type
         */
        private function define_constants() {
            $this->define( 'WP_SIMPLE_BLOCK_PATH', dirname( __FILE__ ) );
            $this->define( 'WP_SIMPLE_BLOCK_INCLUDES_PATH', dirname( __FILE__ ) . '/includes' );
            $this->define( 'WP_SIMPLE_BLOCK_DIST_PATH', dirname( __FILE__ ) . '/dist' );
            $this->define( 'WP_SIMPLE_BLOCK_DIST_URL',plugin_dir_url( __FILE__ ) . 'dist' );
        }

        /**
         * Define constant if not already set
         * 
         * @since 1.0.0
         *
         * @param string $name
         * @param string|bool $value
         * 
         * @return type
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * Load actions
         * 
         * @since 1.0.0
         *
         * @return void
         */
        private function includes() {
            include( WP_SIMPLE_BLOCK_PATH . '/vendor/autoload.php' );
        }

        /**
         * Load actions
         * 
         * @since 1.0.0
         *
         * @return void
         */
        private function dependency_class_instance() {
            \WPSimpleBlock\Includes\Actions::instance();
            \WPSimpleBlock\Includes\Scripts::instance();
        }
    }

endif;

/**
 * The main function for that returns WPSimpleBlock
 *
 * @since 1.0.0
 * 
 * @return WPSimpleBlock
 */
function wp_simple_block() {
    return WPSimpleBlock::instance();
}

// Get the plugin running. Load on plugins_loaded action to avoid issue on multisite.
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
    add_action( 'plugins_loaded', 'wp_simple_block', 90 );
} else {
    wp_simple_block();
}
