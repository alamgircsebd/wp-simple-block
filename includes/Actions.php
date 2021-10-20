<?php
/**
 * Load general WP action hook
 *
 * @since 1.0.0
 */

namespace WPSimpleBlock\Includes;

use Exception;
use WP_REST_Server;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load general WP action hook
 * 
 * @since 1.0.0
 */
class Actions {

    /**
     * Block assets.
     *
     * @since 1.0.0
     * 
     * @var CoBlocks_Accordion_IE_Support
     *
     * @return void
     */
	private static $instance;

    /**
     * Registers the plugin.
     *
     * @since 1.0.0
     *
     * @return void
     */
	public static function instance() {
		 if ( ! self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
	}

    /**
     * The Constructor.
     *
     * @since 1.0.0
     *
     * @return void
     */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
     * Resgister routes
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_routes() {
        register_rest_route(
            'wp-simple-block/v1',
            '/posts/',
            [
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => [ $this, 'get_posts' ],
                    'permission_callback' => [ $this, 'permission_check' ],
                ]
            ]
        );
    }

    /**
     * Permission check
     *
     * @since 1.0.0
     *
     * @return bool
     */
    public function permission_check() {
        return true;
    }

    /**
     * Get posts.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_posts( $request ) {
        $numberposts = $request->get_param( 'numberposts' );

    	return get_posts( [ 'numberposts' => $numberposts ] );
    }
}
