<?php
/**
 * Load general WP action hook
 *
 * @since 1.0.0
 */

namespace WPSimpleBlock\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load general WP action hook
 * 
 * @since 1.0.0
 */
class Scripts {

	/**
     * This plugin's instance.
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
     * @return instance
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
		add_action( 'enqueue_block_assets', [ $this, 'block_assets' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'block_editor_assets' ] );
	}

	/**
     * Block assets.
     *
     * @since 1.0.0
     *
     * @return void
     */
	public function block_assets() {
		$dependencies = require_once( WP_SIMPLE_BLOCK_DIST_PATH . '/blocks.asset.php' );

		wp_enqueue_script(
		    'wp-simple-block-block',
		    WP_SIMPLE_BLOCK_DIST_URL . '/blocks.js',
		    $dependencies['dependencies'],
		    $dependencies['version'],
		    true
		);

		wp_enqueue_style(
		    'wp-simple-block-block-style',
		    WP_SIMPLE_BLOCK_DIST_URL . '/style.css',
		    false,
		    time(),
		    'all'
		);
	}

	/**
     * Block editor assets.
     *
     * @since 1.0.0
     *
     * @return void
     */
	public function block_editor_assets() {
		wp_enqueue_style( 'wp-simple-block-block-editor-style', WP_SIMPLE_BLOCK_DIST_URL . '/editor.css', false, time(), 'all' );
	}
}
