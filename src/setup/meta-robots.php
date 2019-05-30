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
add_action(
	'wp_head',
	function() {
		$meta_robots = [];

		if ( is_singular() && ! is_front_page() ) {
			$meta_robots = get_post_meta( get_the_ID(), 'wp-seo-meta-robots', true );
		}

		$meta_robots = apply_filters( 'wp_seo_meta_robots', $meta_robots ); // @deprecated
		$meta_robots = apply_filters( 'inc2734_wp_seo_meta_robots', $meta_robots );
		if ( ! $meta_robots || ! is_array( $meta_robots ) ) {
			return;
		}
		?>
		<meta name="robots" content="<?php echo esc_attr( implode( ', ', $meta_robots ) ); ?>">
		<?php
	}
);
