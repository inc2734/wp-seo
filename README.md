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

/**
 * Google Analytics Tracking ID
 *
 * @param string $tracking_id
 * @return string
 */
add_filter( 'inc2734_wp_seo_google_analytics_tracking_id', function( $tracking_id ) {
	return $tracking_id;
} );

/**
 * Google Site Verification
 *
 * @param string $google_site_verification
 * @return string
 */
add_filter( 'inc2734_wp_seo_google_site_verification', function( $google_site_verification ) {
	return $google_site_verification;
} );

/**
 * Default og:image
 *
 * @param string $default_ogp_image_url
 * @return string
 */
add_filter( 'inc2734_wp_seo_defult_ogp_image_url', function( $default_ogp_image_url ) {
	return $default_ogp_image_url;
} );

/**
 * When you want to print ogp meta tags, return true
 *
 * @param bool false
 * @return bool
 */
add_filter( 'inc2734_wp_seo_ogp', '__return_true' );

/**
 * twitter:card
 *
 * @param string $twitter_card
 * @return string
 */
add_filter( 'inc2734_wp_seo_twitter_card', function( $twitter_card ) {
	return $twitter_card;
} );

/**
 * twitter:site
 *
 * @param string $twitter_site
 * @return string
 */
add_filter( 'inc2734_wp_seo_twitter_site', function( $twitter_site ) {
	return $twitter_site;
} );
```
