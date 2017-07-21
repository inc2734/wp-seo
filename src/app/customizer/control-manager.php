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
			'label'       => __( 'Tracking ID', 'inc2734-wp-seo' ),
			'description' => __( 'e.g. UA-1111111-11', 'inc2734-wp-seo' ),
		) );

		$this->_add( 'text', 'google-site-verification', array(
			'label'       => __( 'Google site verification', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'Please enter part %1$s of %2$s', 'inc2734-wp-seo' ),
				'<code>xxxx</code>',
				'<code>&lt;meta name="google-site-verification" content="xxxxx" /&gt;</code>'
			),
		) );

		$this->_add( 'image', 'default-og-image',array(
			'label'       => __( 'Default OGP image', 'inc2734-wp-seo' ),
			'description' => __( 'If a featured image is set in an article, that the featured image is used, if not set, this image will be used.', 'inc2734-wp-seo' ),
		) );

		$this->_add( 'select', 'twitter-card',array(
			'label'       => __( 'twitter:card', 'inc2734-wp-seo' ),
			'description' => __( 'Twitter Cards format', 'inc2734-wp-seo' ),
			'default'     => 'summary',
			'choices'     => array(
				'summary'             => 'Summary Card',
				'summary_large_image' => 'Summary Card with Large Image',
			),
		) );

		$this->_add( 'text', 'twitter-site',array(
			'label'       => __( 'twitter:site', 'inc2734-wp-seo' ),
			'description' => sprintf(
				__( 'The Twitter account name of the site. Please enter in the form %1$s.', 'inc2734-wp-seo' ),
				'<code>@username</code>'
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
