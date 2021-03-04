# WP SEO

![CI](https://github.com/inc2734/wp-seo/workflows/CI/badge.svg)
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
new \Inc2734\WP_SEO\Bootstrap();
```

## Filter hooks

### inc2734_wp_seo_google_analytics_tracking_id
```
/**
 * Google Analytics Tracking ID
 *
 * @param string $tracking_id
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_analytics_tracking_id',
	function( $tracking_id ) {
		return $tracking_id;
	}
);
```

### inc2734_wp_seo_defult_ogp_image_url
```
/**
 * Default og:image
 *
 * @param string $default_ogp_image_url
 * @return string
 */
add_filter(
	'inc2734_wp_seo_defult_ogp_image_url',
	function( $default_ogp_image_url ) {
		return $default_ogp_image_url;
	}
);
```

### inc2734_wp_seo_ogp
```
/**
 * When you want to print ogp meta tags, return true
 *
 * @param bool false
 * @return bool
 */
add_filter( 'inc2734_wp_seo_ogp', '__return_true' );
```

### inc2734_wp_seo_meta_robots

This filter hook is deprecated.
You can using wp_robots filter hook in WordPress 5.7 or later.

```
/**
 * meta robots
 */
add_filter(
	'inc2734_wp_seo_meta_robots',
	function( $robots ) {
		if ( is_tag() ) {
			$robots = [ 'noindex' ];
		}
		return $robots;
	}
);
```

### inc2734_wp_seo_description
```
/**
 * meta description
 */
add_filter(
	'inc2734_wp_seo_description',
	function( $meta_description ) {
		return $meta_description;
	}
);
```

### inc2734_wp_seo_google_tag_manager_id
```
/**
 * Google Tag Manager ID
 *
 * @param string $tag_manager_id
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_tag_manager_id',
	function( $tag_manager_id ) {
		return $tag_manager_id;
	}
);
```

### inc2734_wp_seo_use_json_ld
```
/**
 * When you want to print structured data (JSON+LD), return true
 *
 * @param bool false
 * @return bool
 */
add_filter( 'inc2734_wp_seo_use_json_ld', '__return_true' );
```

### inc2734_wp_seo_json_ld
```
/**
 * Structured data (JSON+LD)
 *
 * @param array $json_ld
 * @return array
 */
add_filter(
	'inc2734_wp_seo_json_ld',
	function( $json_ld ) {
		return $json_ld;
	}
);
```

### inc2734_wp_seo_twitter_card
```
/**
 * twitter:card
 *
 * @param string $twitter_card
 * @return string
 */
add_filter(
	'inc2734_wp_seo_twitter_card',
	function( $twitter_card ) {
		return $twitter_card;
	}
);
```

### inc2734_wp_seo_twitter_site
```
/**
 * twitter:site
 *
 * @param string $twitter_site
 * @return string
 */
add_filter(
	'inc2734_wp_seo_twitter_site',
	function( $twitter_site ) {
		return $twitter_site;
	}
);
```

### inc2734_wp_seo_google_site_verification
```
/**
 * Google Site Verification
 *
 * @param string $google_site_verification
 * @return string
 */
add_filter(
	'inc2734_wp_seo_google_site_verification',
	function( $google_site_verification ) {
		return $google_site_verification;
	}
);
```

### inc2734_wp_seo_thumbnail
```
/**
 * meta thumbnail
 */
add_filter(
	'inc2734_wp_seo_thumbnail',
	function( $thumbnail ) {
		return $thumbnail;
	}
);
```
