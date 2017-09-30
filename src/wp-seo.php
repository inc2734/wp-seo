<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * WordPress simple SEO library
 */
class Inc2734_WP_SEO {

	public function __construct() {
		load_textdomain( 'inc2734-wp-seo', __DIR__ . '/languages/' . get_locale() . '.mo' );

		$includes = array(
			'/app/controller',
			'/app/setup',
		);
		foreach ( $includes as $include ) {
			foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
				require_once( $file );
			}
		}

		if ( ! class_exists( 'Inc2734_WP_OGP' ) ) {
			$path = get_theme_file_path( '/vendor/inc2734/wp-ogp/src/wp-ogp.php' );
			if ( file_exists( $path ) ) {
				require_once( $path );
			} else {
				require_once( __DIR__ . '/../../wp-ogp/src/wp-ogp.php' );
			}
		}

		new Inc2734_WP_SEO_Posts_Controller();
	}
}
