<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print google-siete-verification meta
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$google_site_verification = apply_filters( 'inc2734_wp_seo_google_site_verification', null );
		if ( ! $google_site_verification ) {
			return;
		}
		?>
		<meta name="google-site-verification" content="<?php echo esc_attr( $google_site_verification ); ?>">
		<?php
	}
);
