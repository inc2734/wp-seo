<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * og:description updated by wp-seo-meta-description
 *
 * @param string $description
 * @return string
 */
add_filter( 'inc2734_wp_ogp_description', function( $description ) {
	if ( ! is_singular() ) {
		if ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
			$meta_description = get_post_meta( get_option( 'page_for_posts' ), 'wp-seo-meta-description', true );
			if ( $meta_description ) {
				return $meta_description;
			}
		}
		return $description;
	}

	$meta_description = get_post_meta( get_the_ID(), 'wp-seo-meta-description', true );
	if ( $meta_description ) {
		return $meta_description;
	}

	return $description;
} );

/**
 * og:image updated by get_theme_mod( 'default-og-image' )
 *
 * @param string $og_image URL of og:image
 */
add_filter( 'inc2734_wp_ogp_image', function( $og_image ) {
	if ( ! empty( $og_image ) ) {
		return $og_image;
	}

	$default_og_image = apply_filters( 'inc2734_wp_seo_defult_ogp_image_url', null );
	if ( $default_og_image ) {
		return $default_og_image;
	}

	return $og_image;
} );

/**
 * Print OGP tags
 *
 * @return void
 */
add_action( 'wp_head', function() {
	if ( ! apply_filters( 'inc2734_wp_seo_ogp', false ) ) {
		return;
	}

	$ogp = new \Inc2734\WP_OGP\OGP();
	?>
	<meta property="og:title" content="<?php echo esc_attr( $ogp->get_title() ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $ogp->get_type() ); ?>">
	<meta property="og:url" content="<?php echo esc_attr( $ogp->get_url() ); ?>">
	<meta property="og:image" content="<?php echo esc_attr( $ogp->get_image() ); ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( $ogp->get_site_name() ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $ogp->get_description() ); ?>">
	<meta property="og:locale" content="<?php echo esc_attr( $ogp->get_locale() ); ?>">
	<?php
} );
