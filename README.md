# WP SEO

[![Build Status](https://travis-ci.org/inc2734/wp-seo.svg?branch=master)](https://travis-ci.org/inc2734/wp-seo)
[![Latest Stable Version](https://poser.pugx.org/inc2734/wp-seo/v/stable)](https://packagist.org/packages/inc2734/wp-seo)
[![License](https://poser.pugx.org/inc2734/wp-seo/license)](https://packagist.org/packages/inc2734/wp-seo)

This library inputs and saves various settings, but does not output.
Please implement the output with your theme.

## Install
```
$ composer require inc2734/wp-seo
```

## How to use
```
<?php
// When Using composer auto loader
// $Basis = new Inc2734\WP_SEO\SEO();

// When not Using composer auto loader
include_once( get_theme_file_path( '/vendor/inc2734/wp-seo/src/wp-seo.php' ) );
new Inc2734_WP_SEO();

// Get meta description
$meta_description = get_post_meta( get_the_ID(), 'wp-seo-meta-description', true );

// Get Google Analytics tracking ID
$tracking_id = get_theme_mod( 'google-analytics-tracking-id' );

// Get meta google-site-verification
$google_site_verification = get_theme_mod( 'google-site-verification' );

// Get default og:image URL
$default_og_image = get_theme_mod( 'default-og-image' );

// OGP
add_action( 'wp_head', function() {
	$ogp = new Inc2734_WP_OGP();
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

// Get twitter:card
$twitter_card = get_theme_mod( 'twitter-card' );

// Get twitter:site
$twitter_site = get_theme_mod( 'twitter-site' );
```
