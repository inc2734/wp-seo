<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print meta robots
 *
 * @return void
 */
add_action( 'wp_head', function() {
	if ( ! is_singular() || ( is_home() && ! is_front_page() ) ) {
		return;
	}

	$meta_robots = get_post_meta( get_the_ID(), 'wp-seo-meta-robots', true );
	if ( ! $meta_robots ) {
		return;
	}
	?>
	<meta name="robots" content="<?php echo esc_attr( implode( ', ', $meta_robots ) ); ?>">
	<?php
} );
