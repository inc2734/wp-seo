<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_SEO\Helper;

/**
 * Print meta thumbnail
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$thumbnail = Helper::get_the_thumbnail();
		if ( ! $thumbnail ) {
			return;
		}
		?>
		<meta name="thumbnail" content="<?php echo esc_url( $thumbnail ); ?>">
		<?php
	}
);
