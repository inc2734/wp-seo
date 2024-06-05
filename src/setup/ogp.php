<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_SEO\Helper;

/**
 * og:description updated by wp-seo-meta-description
 *
 * @param string $description
 * @return string
 */
add_filter(
	'inc2734_wp_ogp_description',
	function ( $description ) {
		$meta_description = Helper::get_the_description();
		return $meta_description ? $meta_description : $description;
	}
);

/**
 * og:image updated by get_theme_mod( 'default-og-image' )
 *
 * @param string $og_image URL of og:image
 */
add_filter(
	'inc2734_wp_ogp_image',
	function ( $og_image ) {
		return $og_image
			? $og_image
			: apply_filters( 'inc2734_wp_seo_defult_ogp_image_url', null );
	}
);

/**
 * Print OGP tags
 *
 * @return void
 */
add_action(
	'wp_head',
	function () {
		if ( ! apply_filters( 'inc2734_wp_seo_ogp', false ) ) {
			return;
		}

		$ogp = new \Inc2734\WP_OGP\Bootstrap();

		$og_title       = $ogp->get_title();
		$og_type        = $ogp->get_type();
		$og_url         = $ogp->get_url();
		$og_image       = $ogp->get_image();
		$og_site_name   = $ogp->get_site_name();
		$og_description = $ogp->get_description();
		$og_locale      = $ogp->get_locale();
		$fb_app_id      = $ogp->get_app_id();
		?>
		<?php if ( $og_title ) : ?>
			<meta property="og:title" content="<?php echo esc_attr( wp_strip_all_tags( $og_title ) ); ?>">
		<?php endif; ?>

		<?php if ( $og_type ) : ?>
			<meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>">
		<?php endif; ?>

		<?php if ( $og_url ) : ?>
			<meta property="og:url" content="<?php echo esc_attr( $og_url ); ?>">
		<?php endif; ?>

		<?php if ( $og_image ) : ?>
			<meta property="og:image" content="<?php echo esc_attr( $og_image ); ?>">
		<?php endif; ?>

		<?php if ( $og_site_name ) : ?>
			<meta property="og:site_name" content="<?php echo esc_attr( $og_site_name ); ?>">
		<?php endif; ?>

		<?php if ( $og_description ) : ?>
			<meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( $og_description ) ); ?>">
		<?php endif; ?>

		<?php if ( $og_locale ) : ?>
			<meta property="og:locale" content="<?php echo esc_attr( $og_locale ); ?>">
		<?php endif; ?>

		<?php if ( $fb_app_id ) : ?>
			<meta property="fb:app_id" content="<?php echo esc_attr( $fb_app_id ); ?>">
		<?php endif; ?>
		<?php
	},
	1
);
