<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

class Inc2734_WP_SEO_Customizer {

	public function __construct() {
		$customizer = Inc2734_WP_Customizer_Framework::init();

		$customizer->panel( 'seo', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_panel_seo_title',
				'SEO'
			),
		) );

		$customizer->section( 'google-analytics', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_google_analytics_title',
				'Google Analytics'
			)
		) );

		$customizer->section( 'google-search-console', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_google_search_console_title',
				'Google Search Console'
			)
		) );

		$customizer->section( 'ogp', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_ogp_title',
				'OGP'
			)
		) );

		$customizer->section( 'twitter-cards', array(
			'title' => apply_filters(
				'inc2734_wp_seo_customizer_section_twitter_cards_title',
				'Twitter Cards'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_section_twitter_cards_description',
				'Application of URL is necessary for using Twitter Cards.'
			) . '<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>',
		) );

		$customizer->control( 'text', 'google-analytics-tracking-id', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_analytics_tracking_id_label',
				'Tracking ID'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_analytics_tracking_id_description',
				'e.g. UA-1111111-11'
			),
		) );

		$customizer->control( 'text', 'google-site-verification', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_site_verification_label',
				'Google site verification'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_site_verification_description',
				'Please enter part <code>xxxx</code> of <code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
			),
		) );

		$customizer->control( 'image', 'default-og-image', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_default_og_image_label',
				'Default OGP image'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_default_og_image_description',
				'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.'
			),
		) );

		$customizer->control( 'select', 'twitter-card', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_twitter_card_label',
				'twitter:card'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_twitter_card_description',
				'Twitter Cards format'
			),
			'default' => 'summary',
			'choices' => array(
				'summary'             => 'Summary Card',
				'summary_large_image' => 'Summary Card with Large Image',
			),
		) );

		$customizer->control( 'text', 'twitter-site', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_twitter_site_label',
				'twitter:site'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_twitter_site_description',
				'The Twitter account name of the site. Please enter in the form <code>@username</code>.'
			),
			'default' => '@',
		) );

		$panel   = $customizer->get_panel( 'seo' );
		$section = $customizer->get_section( 'google-analytics' );
		$control = $customizer->get_control( 'google-analytics-tracking-id' );
		$control->join( $section )->join( $panel );

		$section = $customizer->get_section( 'google-search-console' );
		$control = $customizer->get_control( 'google-site-verification' );
		$control->join( $section )->join( $panel );

		$section = $customizer->get_section( 'ogp' );
		$control = $customizer->get_control( 'default-og-image' );
		$control->join( $section )->join( $panel );

		$section = $customizer->get_section( 'twitter-cards' );
		$control = $customizer->get_control( 'twitter-card' );
		$control->join( $section )->join( $panel );
		$control = $customizer->get_control( 'twitter-site' );
		$control->join( $section )->join( $panel );
	}
}
