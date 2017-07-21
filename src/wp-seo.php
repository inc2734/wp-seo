<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

$includes = array(
	'/app/controller',
	'/app/customizer',
);
foreach ( $includes as $include ) {
	foreach ( glob( __DIR__ . $include . '/*.php' ) as $file ) {
		require_once( $file );
	}
}

if ( ! class_exists( 'Inc2734_WP_Customizer_Framework' ) ) {
	$wp_customizer_framework_path = get_theme_file_path( '/vendor/inc2734/wp-customizer-framework/src/wp-customizer-framework.php' );
	if ( file_exists( $wp_customizer_framework_path ) ) {
		require_once( $wp_customizer_framework_path );
	} else {
		require_once( __DIR__ .  '/../../wp-customizer-framework/src/wp-customizer-framework.php' );
	}
}

if ( ! class_exists( 'Inc2734_WP_OGP' ) ) {
	$wp_customizer_framework_path = get_theme_file_path( '/vendor/inc2734/wp-ogp/src/wp-ogp.php' );
	if ( file_exists( $wp_customizer_framework_path ) ) {
		require_once( $wp_customizer_framework_path );
	} else {
		require_once( __DIR__ .  '/../../wp-ogp/src/wp-ogp.php' );
	}
}

class Inc2734_WP_SEO {

	public function __construct() {
		load_textdomain( 'inc2734-wp-seo', __DIR__ . '/languages/' . get_locale() . '.mo' );

		new Inc2734_WP_SEO_Meta();
		new Inc2734_WP_SEO_Customizer();
	}
}
