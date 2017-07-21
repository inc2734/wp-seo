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
			'title' => __( 'SEO', 'inc2734-wp-seo' ),
		) );

		$customizer->section( 'google-analytics', array(
			'title' => __( 'Google Analytics', 'inc2734-wp-seo' ),
		) );

		$customizer->section( 'google-search-console', array(
			'title' => __( 'Google Search Console', 'inc2734-wp-seo' ),
		) );

		$customizer->section( 'ogp', array(
			'title' => __( 'OGP', 'inc2734-wp-seo' ),
		) );

		$customizer->section( 'twitter-cards', array(
			'title'       => __( 'Twitter Cards', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'Application of URL is necessary for using Twitter Cards. %1$s', 'inc2734-wp-seo' ),
				'<a href="https://cards-dev.twitter.com/validator" target="_blank">Card validator</a>'
			),
		) );

		$customizer->control( 'text', 'google-analytics-tracking-id', array(
			'label'       => __( 'Tracking ID', 'inc2734-wp-seo' ),
			'description' => __( 'e.g. UA-1111111-11', 'inc2734-wp-seo' ),
		) );

		$customizer->control( 'text', 'google-site-verification', array(
			'label'       => __( 'Google site verification', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'Please enter part %1$s of %2$s', 'inc2734-wp-seo' ),
				'<code>xxxx</code>',
				'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
			),
		) );

		$customizer->control( 'image', 'default-og-image', array(
			'label'       => __( 'Default OGP image', 'inc2734-wp-seo' ),
			'description' => __( 'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.', 'inc2734-wp-seo' ),
		) );

		$customizer->control( 'select', 'twitter-card', array(
			'label'       => __( 'twitter:card', 'inc2734-wp-seo' ),
			'description' => __( 'Twitter Cards format', 'inc2734-wp-seo' ),
			'default'     => 'summary',
			'choices'     => array(
				'summary'             => 'Summary Card',
				'summary_large_image' => 'Summary Card with Large Image',
			),
		) );

		$customizer->control( 'text', 'twitter-site', array(
			'label'       => __( 'twitter:site', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'The Twitter account name of the site. Please enter in the form %1$s.', 'inc2734-wp-seo' ),
				'<code>@username</code>'
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
