<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

/**
 * Print Google Analytics script
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		$tracking_id = apply_filters( 'inc2734_wp_seo_google_analytics_tracking_id', null );
		if ( ! $tracking_id ) {
			return;
		}

		if (
			! preg_match( '/^UA-\d+-\d+$/', $tracking_id )
			&& ! preg_match( '/^G-[0-9A-Z]+$/', $tracking_id )
		) {
			return;
		}

		wp_enqueue_script(
			'inc2734-wp-seo-google-analytics',
			esc_url( 'https://www.googletagmanager.com/gtag/js?id=' . $tracking_id ),
			[],
			1,
			false
		);

		wp_add_inline_script(
			'inc2734-wp-seo-google-analytics',
			"window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments)}; gtag('js', new Date()); gtag('config', '{$tracking_id}');",
			'after'
		);
	}
);
