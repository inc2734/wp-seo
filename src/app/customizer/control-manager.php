<?php
/**
 * @package inc2734/wp-seo
 * @author inc2734
 * @license GPL-2.0+
 */

class Inc2734_WP_SEO_Customizer_Control_Manager {

	protected $customizer;
	protected $controls = array();

	public function __construct( Inc2734_WP_Customizer_Framework $customizer ) {
		$this->customizer = $customizer;

		$this->_add( 'text', 'google-analytics-tracking-id', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_analytics_tracking_id_label',
				'Tracking ID'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_analytics_tracking_id_description',
				'e.g. UA-1111111-11'
			),
		) );

		$this->_add( 'text', 'google-site-verification', array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_site_verification_label',
				'Google site verification'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_google_site_verification_description',
				'Please enter part <code>xxxx</code> of <code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
			),
		) );

		$this->_add( 'image', 'default-og-image',array(
			'label' => apply_filters(
				'inc2734_wp_seo_customizer_control_default_og_image_label',
				'Default OGP image'
			),
			'description' => apply_filters(
				'inc2734_wp_seo_customizer_control_default_og_image_description',
				'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.'
			),
		) );

		$this->_add( 'select', 'twitter-card',array(
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

		$this->_add( 'text', 'twitter-site',array(
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
	}

	public function get( $controls_id ) {
		if ( isset( $this->controls[ $controls_id ] ) ) {
			return $this->controls[ $controls_id ];
		}
	}

	protected function _add( $type, $id, $args ) {
		$control = $this->customizer->Control( $type, $id, $args );
		$this->controls[ $control->get_id() ] = $control;
	}
}
