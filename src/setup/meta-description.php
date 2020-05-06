<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_SEO\Helper;

/**
 * Print meta description
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$meta_description = Helper::get_the_description();
		if ( ! $meta_description ) {
			return;
		}
		?>
		<meta name="description" content="<?php echo esc_attr( $meta_description ); ?>">
		<?php
	},
	1
);
