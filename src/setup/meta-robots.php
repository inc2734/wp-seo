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
add_filter(
	'wp_robots',
	function( $robots ) {
		$new_robots = [];

		if ( is_singular() && ! is_front_page() ) {
			$new_robots = get_post_meta( get_the_ID(), 'wp-seo-meta-robots', true );
			$new_robots = ! is_array( $new_robots ) ? [] : $new_robots;
		}

		$new_robots = apply_filters( 'wp_seo_meta_robots', $new_robots ); // @deprecated
		$new_robots = apply_filters( 'inc2734_wp_seo_meta_robots', $new_robots );

		foreach ( $new_robots as $value ) {
			$robots[ $value ] = true;
		}

		return $robots;
	}
);
