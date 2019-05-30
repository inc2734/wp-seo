<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print meta thumbnail for sngular page
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		if ( ! is_singular() || is_home() || is_front_page() ) {
			return;
		}

		$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$thumbnail    = wp_get_attachment_image_url( $thumbnail_id, 'full' );
		$thumbnail    = apply_filters( 'inc2734_wp_seo_thumbnail', $thumbnail );

		if ( ! $thumbnail ) {
			return;
		}
		?>
		<meta name="thumbnail" content="<?php echo esc_url( $thumbnail ); ?>">
		<?php
	}
);
