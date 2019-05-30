<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_SEO;

use Inc2734\WP_SEO\App\Controller;

class Bootstrap {

	public function __construct() {
		load_textdomain( 'inc2734-wp-seo', __DIR__ . '/languages/' . get_locale() . '.mo' );

		$includes = array(
			'/setup',
		);
		foreach ( $includes as $include ) {
			foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
				require_once( $file );
			}
		}

		new Controller\Posts();
	}
}
