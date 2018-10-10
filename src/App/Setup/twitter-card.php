<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print Twitter Cards tags
 *
 * @return void
 */
add_action(
	'wp_head',
	function() {
		$twitter_card = apply_filters( 'inc2734_wp_seo_twitter_card', null );
		$twitter_site = apply_filters( 'inc2734_wp_seo_twitter_site', null );
		?>
		<?php if ( $twitter_card ) : ?>
			<meta name="twitter:card" content="<?php echo esc_attr( $twitter_card ); ?>">
		<?php endif; ?>

		<?php if ( preg_match( '/^@[^@]+$/', $twitter_site ) ) : ?>
			<meta name="twitter:site" content="<?php echo esc_attr( $twitter_site ); ?>">
		<?php endif; ?>
		<?php
	}
);
