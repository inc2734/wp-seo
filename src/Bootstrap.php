<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Inc2734\WP_SEO;

use Inc2734\WP_SEO\App\Controller;

class Bootstrap {

	/**
	 * Constructor.
	 */
	public function __construct() {
		load_textdomain( 'inc2734-wp-seo', __DIR__ . '/languages/' . get_locale() . '.mo' );

		include_once( __DIR__ . '/setup/google-analytics-tracking-id.php' );
		include_once( __DIR__ . '/setup/google-site-verification.php' );
		include_once( __DIR__ . '/setup/google-tag-manager-id.php' );
		include_once( __DIR__ . '/setup/json-ld.php' );
		include_once( __DIR__ . '/setup/meta-description.php' );
		include_once( __DIR__ . '/setup/meta-robots.php' );
		include_once( __DIR__ . '/setup/meta-thumbnail.php' );
		include_once( __DIR__ . '/setup/ogp.php' );
		include_once( __DIR__ . '/setup/twitter-card.php' );

		new Controller\Posts();
	}
}
